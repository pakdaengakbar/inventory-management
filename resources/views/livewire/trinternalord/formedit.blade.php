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
                    <a href="/inventory/intorder/print/{{ $dtheader['id'] }}" class="btn btn-sm btn-success" title='print'>
                        <i class="mdi mdi-printer-outline"></i> Print</a>
                    <a href="/inventory/intorder" type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-redo-variant"></i> Back</a>
                </div>
            </div><!-- end card header -->
            <form class="form-horizontal"  method="POST" id="update-form" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <!-- start header -->
                        <div class="col-lg-6">
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
                                    <input type="text" class="form-control text-center bg-light" name="cstatus" value="{{ MyHelper::_getstatus($dtheader['cstatus']) }}"
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
                                <div class="col-sm-2" hidden>
                                    <input readonly class="form-control text-center bg-light" name="id" value="{{ $dtheader['id'] }}">
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
                                        <td><input type="number" class="form-control text-center form-control-sm qty-input"  name="icode[{{ $no }}][qty]" data-price="{{ $row->nprice }}" value="{{ $row->nqty }}"></td>
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
                    <button type="button" onclick='update_data("/inventory/rwdata/ioupdate", "/inventory/intorder");' id='btn-save1' class="btn btn-primary btn-sm waves-effect waves-light">
                        <i class="mdi mdi-content-save"></i> Update
                    </button>
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
                    <td><input type="number" class="form-control text-center form-control-sm qty-add" name="icode[${ctr}][qty]" data-price="${data.rprice.replace(/,/g, '')}" value="1"></td>
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

</script>
@endsection
