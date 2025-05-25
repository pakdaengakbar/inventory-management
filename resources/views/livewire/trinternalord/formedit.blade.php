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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="float-start d-flex justify-content-center">
                    <h5 class="card-title mb-0 caption fw-semibold fs-18">{{ $pageTitle }}</h5>
                </div>
                <div class="float-end">
                    <a href="javascript:;" class="btn btn-sm btn-primary" title='print' onclick="printData();">
                        <i class="mdi mdi-printer-outline"></i> Print</a>
                    <a href="javascript:;" class="btn btn-success btn-sm" title="approved" onclick="updateStatus();"  >
                        <i class="mdi mdi mdi-check-all"></i> Complete</a>
                    <a href="/inventory/intorder" type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-redo-variant"></i> Back</a>
                </div>
            </div><!-- end card header -->
            <form class="form-horizontal"  method="POST" id="update-form" enctype="multipart/form-data">
                <div class="card-body">
                    {!! MyHelper::setAlert() !!}
                    {!! MyHelper::setSpinner() !!}
                    <div class="row">
                        <!-- start header -->
                        <div class="col-lg-6">
                            <div class="row mb-2 d-none">
                                <label for="dtrans_date" class="col-sm-2 col-form-label text-end">ID </label>
                                <div class="col-sm-2">
                                    <input readonly class="form-control text-center bg-light" name="id" id="id" value="{{ $dtheader['id'] }}">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="dtrans_date" class="col-sm-2 col-form-label text-end">Date </label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" value="{{ $dtheader['dtrans_date'] }}" name="dtrans_date" placeholder="Enter date">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="csupplier_id" class="col-sm-2 col-form-label text-end">Supplier</label>
                                <div class="col-sm-6">
                                    <select class="form-select @error('csupplier_id') is-invalid @enderror" name="csupplier_id">
                                        <option value="" disabled>Select Supplier</option>
                                        @foreach ($suppliers as $s)
                                            <option value="{{ $s->id }}" {{ $s->id == $dtheader['csupplier_id'] ? 'selected' : '' }}>{{ ucwords(strtolower($s->cname)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row mb-2">
                                <label for="cno_inorder" class="col-sm-2 col-form-label text-end">IO Number</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control bg-light" id="cno_inorder" name="cno_inorder" value="{{ $dtheader['cno_inorder'] }}"
                                        placeholder="Enter Internal Order" readonly>
                                </div>
                                <label for="cstatus" class="col-sm-2 col-form-label text-center">Status</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control text-center bg-light" id="cstatus" name="cstatus" value="{{ MyHelper::_getstatus($dtheader['cstatus']) }}"
                                        placeholder="Status" readonly>
                                </div>
                            </div>
                             <div class="row mb-2">
                                <label for="cregion_id" class="col-sm-2 col-form-label text-end">Region</label>
                                <div class="col-sm-6">
                                    <select class="form-select" name="nregion_id">
                                        <option value="">Select Region</option>
                                        @foreach ($region as $c)
                                            <option value="{{ $c->id }}" {{ $c->id == $dtheader['nregion_id'] ? 'selected' : '' }}>{{ ucfirst($c->id.' - '.$c->cname) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                          	</div>
                        </div>
                    </div>
                    <!-- end header -->
                    <hr>
                    <div class="mb-3" wire:ignore>
                        <div class="row mb-3 row-cols-lg-auto g-3 align-items-center">
                            <label for="citem" class="form-label">Item Name</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" onkeydown="findProductEvent(event)" onkeyup="this.value=toUCword(this.value);" placeholder="Product Code / Name" id="barcode" aria-describedby="ProductName">
                                    <span class="input-group-text">
                                        <a href="javascript:;" id="btn_item_search" class="text-primary" onclick="findProductName()">Search</a>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-success btn-sm add_item"><i class="mdi mdi-plus"></i>Add Item</button>
                            </div>
                        </div>
                        <table id="itemDTatable" class="table table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th class="col-1">No</th>
                                    <th>Item Code</th>
                                    <th>Item Name</th>
                                    <th class="col-1">Qty</th>
                                    <th class="col-1">Uom</th>
                                    <th class="col-2">Harga</th>
                                    <th class="col-1 text-center">Delete</th>
                                </tr>
                            </thead>
                            <tbody class="input_fields_wrap">
                                @forelse ($dtdetail as $row)
                                    <tr>
                                        <td><input readonly type="text" class="form-control text-center bg-light form-control-sm" value="{{ $no }}"></td>
                                        <td hidden><input readonly type="text" class="form-control bg-light form-control-sm" name="icode[{{ $no }}][iid]" value="{!! $row->id !!}"></td>
                                        <td><input readonly type="text" class="form-control bg-light form-control-sm" name="icode[{{ $no }}][item_code]" value="{!! $row->citem_code !!}"></td>
                                        <td><input readonly type="text" class="form-control bg-light form-control-sm" name="icode[{{ $no }}][item_name]" value="{!! $row->citem_name !!}"></td>
                                        <td>
                                            <input type="text" class="form-control text-center form-control-sm qty-input"
                                                onkeydown="if(event.keyCode==13){event.preventDefault();return false;} if(!((event.keyCode>=48 && event.keyCode<=57) || (event.keyCode>=96 && event.keyCode<=105) || event.keyCode==8 || event.keyCode==37 || event.keyCode==39 || event.keyCode==46)){event.preventDefault();}"
                                                name="icode[{{ $no }}][qty]" data-price="{{ $row->nprice }}" value="{{ $row->nqty }}"></td>
                                        <td><input readonly type="text" class="form-control bg-light form-control-sm" name="icode[{{ $no }}][uom]" value="{{ $row->cuom }}"></td>
                                        <td><input readonly type="text" class="form-control text-end bg-light form-control-sm"  name="icode[{{ $no }}][price]" value="{{ number_format($row->nprice) }}"></td>
                                        <td class="text-center"><button class="btn btn-sm btn-icon btn-warning remove_item disabled"><i class="mdi mdi-delete-empty"></i></button></td>
                                    </tr>
                                    @php $no++; @endphp
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No data available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <input hidden class="col-sm-1 form-control bg-light form-control-sm text-center"  readonly id="lastnum" value="{{ $no }}">
                    </div>
                    <!-- start footer -->
                    <hr>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="row mb-3">
                                <label for="cnotes" class="col-sm-2 col-form-label text-end">Notes </label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" rows="3" name="cnotes"  onkeyup="this.value=toUCword(this.value);" placeholder="Enter notes">{{ $dtheader['cnotes'] }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="ntotal" class="col-sm-2 col-form-label text-end">Approved </label>
                                <div class="col-sm-6">
                                    <input class="form-control" list="rowdata" name="capprove" id="capprove" onkeyup="this.value=toUCword(this.value);"  value="{{ $dtheader['capprove'] }}" placeholder="Type to search...">
                                    <datalist id="rowdata">
                                        @foreach ($employee as $e)
                                            <option value="{{ ucwords(strtolower($e->cname)) }}">{{ ucwords(strtolower($e->cname)) }}</option>
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row mb-3 justify-content-end">
                                <label for="ntotal" class="col-sm-2 col-form-label text-end">Total </label>
                                <div class="col-sm-4">
                                    <input readonly type="text" class="form-control text-end bg-light" id='ntotal' name="ntotal" value="{{ $dtheader['ntotal'] }}" placeholder="Total">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end footer -->
                </div>
                <div class="card-footer float-end">
                    <button type="button" onclick='updateCheck();' id='btn-update2' class="btn btn-primary btn-sm waves-effect waves-light">
                        <i class="mdi mdi-content-save"></i> Update
                    </button>
                    <a href="javascript:;" class="btn btn-success btn-sm" title="approved" onclick="updateStatus();"  >
                        <i class="mdi mdi mdi-check-all"></i> Complete</a>
                    <a href="/inventory/intorder" type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-redo-variant"></i> Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal -->
@include('livewire.trinternalord.prodsearch');
</div> <!-- container-fluid -->
</div>

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    const last = $("#lastnum").val();
    const btn_additem = document.querySelector('.add_item');
    const wrapper = document.querySelector('.input_fields_wrap');

    let ctr = last-1, no = last-1;
    let xtotal = 0, total = 0;
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
            if (data.error) {
                viewAlert(data.error);
                console.error(data.error);
                return;
            }
            const row = `
                 <tr>
                    <td><input readonly type="text" class="form-control text-center bg-light form-control-sm" value="${no}"></td>
                    <td hidden><input readonly type="text" class="form-control bg-light form-control-sm" name="icode[${ctr}][iid]"></td>
                    <td><input readonly type="text" class="form-control bg-light form-control-sm" name="icode[${ctr}][item_code]" value="${data.icode}"></td>
                    <td><input readonly type="text" class="form-control bg-light form-control-sm" name="icode[${ctr}][item_name]" value="${data.iname}"></td>
                    <td>
                        <input type="text" class="form-control text-center form-control-sm qty-add"
                            onkeydown="if(event.keyCode==13){event.preventDefault();return false;} if(!((event.keyCode>=48 && event.keyCode<=57) || (event.keyCode>=96 && event.keyCode<=105) || event.keyCode==8 || event.keyCode==37 || event.keyCode==39 || event.keyCode==46)){event.preventDefault();}"
                            name="icode[${ctr}][qty]" data-price="${data.rprice.replace(/,/g, '')}" value="1">
                    </td>
                    <td><input readonly type="text" class="form-control bg-light form-control-sm" name="icode[${ctr}][uom]" value="${data.runit}"></td>
                    <td><input readonly type="text" class="form-control text-end bg-light form-control-sm" name="icode[${ctr}][price]" value="${data.rprice}"></td>
                    <td class="text-center"><button class="btn btn-sm btn-icon btn-warning remove_field"><i class="mdi mdi-delete-empty"></i></button></td>
                    <td hidden><input  readonly type="text" class="form-control text-center bg-light form-control-sm" name="icode[${ctr}][barcode]" value="${data.barcode}"></td>
                </tr>
           `;
            let found = false;
            wrapper.querySelectorAll('input[name^="icode"][name$="[item_code]"]').forEach(function(input) {
                if (input.value === data.icode) {
                    let qtyInput = input.closest('tr').querySelector('input[name^="icode"][name$="[qty]"]');
                    qtyInput.value = parseInt(qtyInput.value) + 1;
                    found = true;
                }
            });
            if (!found) {
                wrapper.insertAdjacentHTML('beforeend', row);
            }
            document.querySelector("#barcode").value = "";
            document.querySelector("#barcode").focus();

            const price = parseFloat(data.rprice.replace(/,/g, '')) || 0;
            total += price;
            // calculate total
            xtotal = total + parseFloat($("#ntotal").val().replace(/,/g, '')) || 0;
            ntotal.value = addRupiah(xtotal);
        });
    });
}); // end document ready
// Recalculate total on qty input change
document.querySelectorAll('.qty-input').forEach(input => {
    input.addEventListener('input', calculateTotal);
});
// Use event delegation for dynamically added .qty-add inputs
document.querySelector('.input_fields_wrap').addEventListener('input', function(e) {
    if (e.target && e.target.classList.contains('qty-add')) {
        calculateTotal();
    }
});
// Initial calculation on page load
window.addEventListener('DOMContentLoaded', calculateTotal);

function printData() {
    // Get the id value from the hidden input in the form
    var idInput = document.querySelector('input[name="id"]');
    if (!idInput) {
        alert('ID not found');
        return;
    }
    var id = idInput.value;
    var cLink = "/inventory/intorder/print/" + id;
    window.open(cLink, "_blank", "menubar=no,location=no,status=yes,toolbar=no,directoris=no,scrollbars=yes,resizable=yes,top=100,left=500,width=1000,height=750");
}

function updateCheck(){
    if ( checkStatusOpen() == true){
        update_data("/inventory/rwdata/ioupdate", "/inventory/intorder");
    }else{
        viewAlert('Error, Status Already Close / Progress');
    }
    pageScrollUp();
}

function updateStatus(){
    if ( checkStatusOpen() == true){
        const approved  = $("#capprove").val();
        const progress  = document.getElementById('progress');
        if(approved.length==0){
            $("#capprove").focus();
            viewAlert('error, Approved Empty..!');
            return false;
        }
        var id	= $("#id").val();
        $.ajax({
            type	: 'POST',
            url		: "/inventory/rwdata/ioapproved",
            data	: "id="+id+"&approved="+approved,
            dataType: "json",
            beforeSend: function() {
                    progress.removeAttribute('hidden');
            },
            success	: function(data){
                    bootstrap.Alert.getOrCreateInstance(progress).close();
                    $('#cstatus').val(data.status);
            },
            error: function(jqXHR, exception){
                console.log('error load model');
                console.log(jqXHR.status);
            }
        });
    }else{
        viewAlert('Error, Status Already Close / Progress');
    }
    pageScrollUp();
}

</script>
@endsection
