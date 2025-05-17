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
        {!! MyHelper::setAlert() !!}
        <div class="card">
            <div class="card-header">
                <div class="float-start d-flex justify-content-center">
                    <h5 class="card-title mb-0 caption fw-semibold fs-18">{{ $pageTitle }}</h5>
                </div>
                <div class="float-end">
                    <button type="button" onclick='_save_data();' id='btn-save1' class="btn btn-primary btn-sm waves-effect waves-light">
                        <i class="mdi mdi-content-save"></i> Save
                    </button>
                    <a href="/inventory/puorder" type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-redo-variant"></i> Back</a>
                </div>
            </div><!-- end card header -->
            <div wire:ignore>
            <form class="form-horizontal"  method="POST" id="input-form" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <!-- start header -->
                        <div class="col-lg-6">
                            <fieldset class="row mb-3 justify-content-center">
                                <label for="dtrans_date" class="col-sm-2 col-form-label text-end">Date </label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="dtrans_date" placeholder="Enter date">
                                </div>
                                <legend class="col-form-label col-sm-2 pt-0 text-end mt-2">Type Order</legend>
                                <div class="col-sm-4 d-flex gap-2 mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="ioRadios" value="IO" checked>
                                        <label class="form-check-label" for="ioRadios">
                                            I.O
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="qoRadios" value="QO">
                                        <label class="form-check-label" for="qoRadios">
                                            Q.O
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="row mb-3">
                                <label for="cno_order" class="col-sm-2 col-form-label text-end">No. IO/QO</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="cno_order" name="cno_order" placeholder="Enter Order Number">
                                        <span class="input-group-text">
                                            <a href="javascript:;" id="btn_search_order" class="text-primary">
                                                <i class="mdi mdi-magnify" style="font-size: 1rem;"></i>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="csupplier_id" class="col-sm-2 col-form-label text-end">Supplier</label>
                                <div class="col-sm-5">
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
                                <label for="cno_inorder" class="col-sm-2 col-form-label text-end">PO Number</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="cno_inorder" name="cno_inorder" value="{{ $no_inorder }}"
                                        placeholder="Enter Internal Order" readonly>
                                </div>
                                <label for="cstatus" class="col-sm-2 col-form-label text-center">Status</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control text-center" name="cstatus"  value="{{ MyHelper::_getstatus('O') }}" placeholder="Status" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                {!! MyHelper::setOPayentType() !!}

                                <label for="dtrans_date" class="col-sm-2 col-form-label text-end">Due Date </label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="ddue_date" placeholder="Enter date">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="cno_inorder" class="col-sm-2 col-form-label text-end">Invoice</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="csupplier_inv" name="csupplier_inv" placeholder="Supplier Invoice">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end header -->
                    <hr>
                    <div class="row mb-3 row-cols-lg-auto g-2 align-items-center">
                        <label for="citem" class="form-label">Item Kode</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" class="form-control" onkeydown="findProductEvent(event)" onkeyup="this.value=toUCword(this.value);" placeholder="Product Code / Name" id="barcode" aria-describedby="ProductName">
                                <span class="input-group-text">
                                    <a href="javascript:;" id="btn_item_search" class="text-primary" onclick="findProductName()">Find </a>
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
                                <label for="nsub_tot" class="col-sm-2 col-form-label text-end">Sub Total </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control text-end bg-light" name="nsub_tot" id="nsub_tot" placeholder="Sub Total">
                                </div>
                            </div>
                             <div class="row mb-3 justify-content-end">
                                <label for="nppn" class="col-sm-2 col-form-label text-end">PPN </label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control text-center" name="nppn" id="nppn" value='{{ $ppn }}' placeholder="Ppn">
                                </div>
                                <div class="col-sm-3">
                                    <input readonly type="text" class="form-control text-end bg-light" name="ntot_ppn" id="ntot_ppn" placeholder="Total PPN">
                                </div>
                            </div>
                            <div class="row mb-3 justify-content-end">
                                <label for="ntotal" class="col-sm-2 col-form-label text-end">Total </label>
                                <div class="col-sm-5">
                                    <input readonly type="text" class="form-control text-end bg-light" name="ntotal" id="ntotal" placeholder="Total">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end footer -->
                </div>
                <div class="card-footer float-end">
                    <button type="button" onclick='_save_data();' id='btn-save2' class="btn btn-primary btn-sm waves-effect waves-light">
                        <i class="mdi mdi-content-save"></i> Save
                    </button>
                    <a href="/inventory/puorder" type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-redo-variant"></i> Back</a>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<!-- modal -->
@include('livewire.trinternalord.prodsearch');
</div> <!-- container-fluid -->
</div>

@section('script')
<script>
// Use emit inside Livewire-ready event
document.addEventListener('DOMContentLoaded', function () {
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
            if (data.error) {
                console.error(data.error);
                return;
            }
            const row = `
                <tr>
                    <td><input readonly type="text" class="form-control text-center bg-light form-control-sm" value="${no}"></td>
                    <td hidden><input readonly type="text" class="form-control bg-light form-control-sm" name="icode[${ctr}][barcode]" value="${data.barcode}"></td>
                    <td><input readonly type="text" class="form-control bg-light form-control-sm" name="icode[${ctr}][item_code]" value="${data.icode}"></td>
                    <td><input readonly type="text" class="form-control bg-light form-control-sm" name="icode[${ctr}][item_name]" value="${data.iname}"></td>
                    <td><input type="text" class="form-control text-center form-control-sm" name="icode[${ctr}][qty]" value="1"></td>
                    <td><input readonly type="text" class="form-control bg-light form-control-sm" name="icode[${ctr}][uom]" value="${data.runit}"></td>
                    <td><input readonly type="text" class="form-control text-end bg-light form-control-sm" name="icode[${ctr}][price]" value="${data.rprice}"></td>
                    <td class="text-center"><button class="btn btn-sm btn-icon btn-warning remove_field"><i class="mdi mdi-delete-empty"></i></button></td>
                </tr>
            `;
            wrapper.insertAdjacentHTML('beforeend', row);
            document.querySelector("#barcode").value = "";
            document.querySelector("#barcode").focus();

            const price = parseFloat(data.rprice.replace(/,/g, '')) || 0;
            total += price;
            _calculated(total)
        });
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        const price = parseFloat($(this).closest('tr').find('input[name^="icode"][name$="[price]"]').val().replace(/,/g, '')) || 0;
        total -= price;
        _calculated(total)
        //console.log(total);
        ctr--; no--;
        e.preventDefault(); $(this).closest('tr').remove();
    });
}); // end document ready
function _calculated(total){
    nsub_tot.value = addRupiah(total);
    ntot_ppn.value = addRupiah((total*nppn.value)/100);
    ntotal.value   = addRupiah(((total*nppn.value)/100)+total);
}
function _save_data(url,href){
    const paytype = document.querySelector("#cpay_type");
    if (paytype.value == null || paytype.value=="") {
        viewAlert('Please Select Payment Type');
        return;
    }
    save_data("/inventory/rwdata/posave", "/inventory/puorder")
}
</script>
@endsection
