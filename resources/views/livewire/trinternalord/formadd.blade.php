@section('title')
    {{ $pageTitle }}
@endsection
@section('page-title')
    {{ $pageDescription }}
@endsection
<div>
<!-- Start Content-->
<div class="container-fluid">
    {!! $pageBreadcrumb !!}
    <!-- General Form -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-start d-flex justify-content-center">
                        <h5 class="card-title mb-0 caption fw-semibold fs-18">{{ $pageDescription }}</h5>
                    </div>
                    <div class="float-end">
                        <a href="/inventory/intorder" type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-redo-variant"></i> Back</a>
                    </div>
                </div><!-- end card header -->
                <form class="form-horizontal"  method="POST" id="id-form" enctype="multipart/form-data" wire:ignore>
                    <div class="card-body">
                        <div class="row">
                            <!-- start header -->
                            <div class="col-lg-6">
                                <div class="row mb-3">
                                    <label for="dtrans_date" class="col-sm-2 col-form-label text-end">Date </label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="dtrans_date" placeholder="Enter date">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="csupplier_id" class="col-sm-2 col-form-label text-end">Supplier</label>
                                    <div class="col-sm-6">
                                        <select class="form-select @error('csupplier_id') is-invalid @enderror" name="csupplier_id" id="csupplier_id">
                                            <option value="" disabled>Select Supplier</option>
                                            @foreach ($suppliers as $s)
                                                <option value="{{ $s->id }}">{{ ucwords(strtolower($s->cname)) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row mb-3">
                                    <label for="cno_inorder" class="col-sm-2 col-form-label text-end">IO Number</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="cno_inorder" name="cno_inorder" value="{{ $no_inorder }}"
                                         placeholder="Enter Internal Order" readonly>
                                    </div>
                                    <label for="cstatus" class="col-sm-2 col-form-label text-center">Status</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control text-center" name="cstatus"  value='O' placeholder="Status" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    {!! MyHelper::setRegionlivewire('cregion_id', false) !!}
                                </div>
                            </div>
                        </div>
                        <!-- end header -->
                        <hr>
                        <div class="row mb-3">
                            <label for="citem" class="form-label">Item Name</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Product Name" id="barcode" aria-describedby="ProductName">
                                    <span class="input-group-text">
                                        <a href="javascript:;" id="btn_item_search" class="text-primary">Search</a>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-success add_item"><i class="mdi mdi-plus"></i>Add Item</button>
                            </div>
                        </div>
                        <table id="itemDTatable" class="table">
                            <thead>
                                <tr>
                                    <th class="col-1">No</th>
                                    <th>Item Code</th>
                                    <th>Item Name</th>
                                    <th class="col-1">Qty</th>
                                    <th class="col-2">Harga</th>
                                    <th class="col-1 text-center">Delete</th>
                                </tr>
                            </thead>
                            <tbody class="input_fields_wrap">
                            </tbody>
                        </table>
                        <hr>
                        <!-- start footer -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row mb-3">
                                    <label for="cnotes" class="col-sm-2 col-form-label text-end">Notes </label>
                                    <div class="col-sm-8">
                                       <textarea class="form-control" rows="3" name="cnotes" onkeyup="this.value=toUCword(this.value);" placeholder="Enter notes"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row mb-3 justify-content-end">
                                    <label for="ntotal" class="col-sm-2 col-form-label text-end">Total </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control text-end" name="ntotal" id="ntotal" placeholder="Total">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end footer -->
                    </div>
                    <div class="card-footer float-end">
                        <button type="button" onclick='save_data();' class="btn btn-primary btn-sm waves-effect waves-light">
                            <i class="mdi mdi-content-save"></i> Save
                        </button>
                        <a href="/inventory/intorder" type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-redo-variant"></i> Back</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div> <!-- container-fluid -->
</div>

@section('script')
<script>
// Use emit inside Livewire-ready event
document.addEventListener('DOMContentLoaded', function () {
    //const ntotal= document.getElementById('mAlert');
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    const btn_additem = document.querySelector('.add_item');
    const wrapper = document.querySelector('.input_fields_wrap');
    let ctr = 0, no = 0, total = 0;

    btn_additem.addEventListener('click', function (e) {
        e.preventDefault();
        const barcode = document.querySelector("#barcode").value;
        if (!barcode) return;
        ctr++; no++;
        fetch("/product/rwdata/getproduct", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: "barcode=" + barcode
        })
        .then(response => response.json())
        .then(data => {
            const row = `
                <tr>
                    <td><input readonly type="text" class="form-control text-center bg-light form-control-sm" value="${no}"></td>
                    <td hidden><input readonly type="text" class="form-control bg-light form-control-sm" name="icode[${ctr}][barcode]" value="${data.barcode}"></td>
                    <td><input readonly type="text" class="form-control bg-light form-control-sm" name="icode[${ctr}][item_code]" value="${data.icode}"></td>
                    <td><input readonly type="text" class="form-control bg-light form-control-sm" name="icode[${ctr}][item_name]" value="${data.iname}"></td>
                    <td><input type="text" class="form-control text-center form-control-sm" name="icode[${ctr}][qty]" value="1"></td>
                    <td><input readonly type="text" class="form-control text-end bg-light form-control-sm" name="icode[${ctr}][price]" value="${data.rprice}"></td>
                    <td class="text-center"><button class="btn btn-sm btn-icon btn-warning remove_field"><i class="mdi mdi-delete-empty"></i></button></td>
                </tr>
            `;
            wrapper.insertAdjacentHTML('beforeend', row);
            document.querySelector("#barcode").value = "";
            document.querySelector("#barcode").focus();

            const price = parseFloat(data.rprice.replace(/,/g, '')) || 0;
            total += price;
            ntotal.value = convertToRupiah(total);
            $("#ntotal").focus();
        });
    });


    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        const price = parseFloat($(this).closest('tr').find('input[name^="icode"][name$="[price]"]').val().replace(/,/g, '')) || 0;
        total -= price;
        ntotal.value = convertToRupiah(total);
        $("#ntotal").focus();
        //console.log(total);
        ctr--; no--;
        e.preventDefault(); $(this).closest('tr').remove();
    });
}); // end document ready

function toUCword(str){
	return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
		return $1.toUpperCase();
	});
}

function convertToRupiah(angka){
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+',';
    return rupiah.split('',rupiah.length-1).reverse().join('');
}

function save_data(){
    var string = $("#id-form").serialize();
    $.ajax({
        type: 'POST',
        url		: "/inventory/rwdata/save",
        data	: string,
        dataType: "json",
        beforeSend: function() {
                $("#progress").show();
        },
        success	: function(data){
                console.log(data);
                if(data.success == true){
                    //alert('Data berhasil disimpan');
                    window.location.href = "/inventory/intorder";
                }else{
                    alert('Data gagal disimpan');
                }
        },
        error: function(jqXHR, exception){
            console.log('error load model');
            console.log(jqXHR.status);
        }

    });
}
</script>
@endsection
