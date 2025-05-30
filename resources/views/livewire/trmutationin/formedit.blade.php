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
                    <a href="javascript:;" class="btn btn-sm btn-primary" title='print' onclick="printData('/inventory/mutin/print/');">
                        <i class="mdi mdi-printer-outline"></i> Print</a>
                    <a href="javascript:;" class="btn btn-success btn-sm" title="approved" onclick="updateStatus('/inventory/rwdata/miapproved', false);"  >
                        <i class="mdi mdi mdi-check-all"></i> Complete</a>
                    <a href="/inventory/mutin" type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-redo-variant"></i> Back</a>
                </div>
            </div><!-- end card header -->
            <form class="form-horizontal"  method="POST" id="update-form" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        {!! MyHelper::setAlert() !!}
                        {!! MyHelper::setSpinner() !!}
                        <!-- start header -->
                        <div class="col-lg-6">
                            <div class="row mb-3 d-none">
                                <label for="dtrans_date" class="col-sm-2 col-form-label text-end">ID </label>
                                <div class="col-sm-2">
                                    <input readonly class="form-control text-center bg-light" name="id" id="id" value="{{ $dtheader['id'] }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="dtrans_date" class="col-sm-3 col-form-label text-end">Date Trans.</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="dtrans_date" placeholder="Enter date">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <legend class="col-form-label col-sm-3 pt-0 text-end mt-2">Type Mutation</legend>
                                <div class="col-sm-5 d-flex gap-3 mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="otRadios" value="OTH" {{ $dtheader["ctype"] == "OTH"  ? "checked" : "" }} >
                                        <label class="form-check-label" for="qoRadios">
                                            OTHER
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="ioRadios" value="MOT" {{ $dtheader["ctype"] == "MOT"  ? "checked" : "" }}>
                                        <label class="form-check-label" for="ioRadios">
                                            MOT
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="qoRadios" value="PO" {{ $dtheader["ctype"] == "PO"  ? "checked" : "" }}>
                                        <label class="form-check-label" for="qoRadios">
                                            PO
                                        </label>
                                    </div>

                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nsrc_region" class="col-sm-3 col-form-label text-end">From Region</label>
                                <div class="col-sm-6">
                                    <select class="form-select" name='nsrc_region' id='nsrc_region'>
                                        <option value="">Select Region</option>
                                        @foreach ($region as $s)
                                            <option value="{{ $s->id }}" {{ $s->id == $dtheader['nsrc_region'] ? 'selected' : '' }}>{{ ucfirst($s->id.' - '.$s->cname) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row mb-3">
                                <label for="cno_mutation" class="col-sm-3 col-form-label text-end">MIN Number</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="cno_mutation" name="cno_mutation" value="{{ $dtheader['cno_mutation'] }}" placeholder="Enter Internal Order" readonly>
                                </div>
                                <label for="cstatus" class="col-sm-2 col-form-label text-center">Status</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control text-center" name="cstatus"  id="cstatus"   value="{{ MyHelper::_getstatus($dtheader['cstatus']) }}" placeholder="Status" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="cshipment" class="col-sm-3 col-form-label text-end">Mutation Code </label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="cno_order" name="cno_order"  value="{{ $dtheader['cno_order'] }}" placeholder="Enter PO / MOT Number">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="ndst_region" class="col-sm-3 col-form-label text-end">To</label>
                                <div class="col-sm-6">
                                    <select class="form-select" name='ndst_region' id = 'ndst_region'>
                                        <option value="">Select Region</option>
                                        @foreach ($region as $c)
                                            <option value="{{ $c->id }}" {{ $c->id == $dtheader['ndst_region'] ? 'selected' : '' }}>{{ ucfirst($c->id.' - '.$c->cname) }}</option>
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
                                        <td><input type="text" class="form-control text-center form-control-sm qty-input"  name="icode[{{ $no }}][qty]" data-price="{{ $row->nprice }}" value="{{ $row->nqty }}"></td>
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
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row mb-3">
                                <label for="cnotes" class="col-sm-2 col-form-label text-end">Notes </label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" rows="3" name="cnotes" onkeyup="this.value=toUCword(this.value);" placeholder="Enter notes">{{ $dtheader['cnotes'] }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="ntotal" class="col-sm-2 col-form-label text-end">Sender </label>
                                <div class="col-sm-6">
                                    <input class="form-control" list="rowdata" name="csender" id="csender" value="{{ $dtheader['csender'] }}" onkeyup="this.value=toUCword(this.value);" placeholder="Type to search...">
                                    <datalist id="rowdata">
                                        @foreach ($employee as $e)
                                            <option value="{{ ucwords(strtolower($e->cname)) }}">{{ ucwords(strtolower($e->cname)) }}</option>
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="ntotal" class="col-sm-2 col-form-label text-end">Recipient </label>
                                <div class="col-sm-6">
                                    <input class="form-control" list="rowdata" name="crecipient" id="crecipient" value="{{ $dtheader['crecipient'] }}" onkeyup="this.value=toUCword(this.value);" placeholder="Type to search...">
                                    <datalist id="rowdata">
                                        @foreach ($employee as $e)
                                            <option value="{{ ucfirst(strtolower($e->cname)) }}">{{ ucwords(strtolower($e->cname)) }}</option>
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row mb-3 justify-content-end">
                                <label for="ntotal" class="col-sm-3 col-form-label text-end">Sub Total</label>
                                <div class="col-sm-4">
                                    <input readonly type="text" class="form-control text-end bg-light" name="nsub_total" id="nsub_total" value="{{ number_format($dtheader['nsub_total']) }}" placeholder="Sub Total">
                                </div>
                            </div>
                            <div class="row mb-3 justify-content-end">
                                <label for="ntotal" class="col-sm-3 col-form-label text-end">Shipping Cost </label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control text-end" name="nshipp_cost" id="nshipp_cost" onkeyup="calculateMOT();" value="{{ number_format($dtheader['nshipp_cost']) }}" placeholder="Shipping Cost">
                                </div>
                            </div>
                            <div class="row mb-3 justify-content-end">
                                <label for="ntotal" class="col-sm-3 col-form-label text-end">Total Item </label>
                                <div class="col-sm-4">
                                    <input readonly type="text" class="form-control text-end bg-light" name="ntotal" id="ntotal" placeholder="Total" value="{{ number_format($dtheader['ntotal']) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end footer -->
                </div>
                <div class="card-footer float-end">
                    <button type="button" onclick='update_data("/inventory/rwdata/miupdate", "/inventory/mutin");' id='btn-update2' class="btn btn-primary btn-sm waves-effect waves-light">
                        <i class="mdi mdi-content-save"></i> Update
                    </button>
                     <a href="javascript:;" class="btn btn-success btn-sm" title="approved" onclick="updateStatus('/inventory/rwdata/miapproved', false);"  >
                        <i class="mdi mdi mdi-check-all"></i> Complete</a>
                    <a href="/inventory/mutin" type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-redo-variant"></i> Back</a>
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
                        <input type="text" class="form-control text-center form-control-sm"
                            onkeydown="if(event.keyCode==13){event.preventDefault();return false;} if(!((event.keyCode>=48 && event.keyCode<=57) || (event.keyCode>=96 && event.keyCode<=105) || event.keyCode==8 || event.keyCode==37 || event.keyCode==39 || event.keyCode==46)){event.preventDefault();}"
                            name="icode[${ctr}][qty]" data-price="${data.rprice.replace(/,/g, '')}" value="1">
                    </td>
                    <td><input readonly type="text" class="form-control bg-light form-control-sm" name="icode[${ctr}][uom]" value="${data.runit}"></td>
                    <td><input readonly type="text" class="form-control text-end bg-light form-control-sm" name="icode[${ctr}][price]" value="${data.rprice}"></td>
                    <td class="text-center"><button class="btn btn-sm btn-icon btn-warning remove_field"><i class="mdi mdi-delete-empty"></i></button></td>
                    <td hidden><input  readonly type="text" class="form-control text-center bg-light form-control-sm" name="icode[${ctr}][barcode]" value="${data.barcode}"></td>
                </tr>
           `;
            wrapper.insertAdjacentHTML('beforeend', row);
            document.querySelector("#barcode").value = "";
            document.querySelector("#barcode").focus();

            const price = parseFloat(data.rprice.replace(/,/g, '')) || 0;
            total += price;
            // calculate total
            xtotal = total + parseFloat($("#nsub_total").val().replace(/,/g, '')) || 0;
            $("#nsub_total").val(addRupiah(xtotal));
        });
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        ctr--; no--;
        const price = parseFloat($(this).closest('tr').find('input[name^="icode"][name$="[price]"]').val().replace(/,/g, '')) || 0;
        total -= price;
        e.preventDefault(); $(this).closest('tr').remove();
        // calculate total
        xtotal = parseFloat($("#nsub_total").val().replace(/,/g, '')) - price;
        $("#nsub_total").val(addRupiah(xtotal));
    });
}); // end document ready

// Recalculate total on qty input change
document.querySelectorAll('.qty-input').forEach(input => {
    input.addEventListener('input', calculateMOT);
});

// Initial calculation on page load
window.addEventListener('DOMContentLoaded', calculateMOT);

function calculateMOT() {
    const subtotal = parseFloat(document.getElementById('nsub_total').value.replace(/,/g, '')) || 0;
    const shipping = parseFloat(document.getElementById('nshipp_cost').value.replace(/,/g, '')) || 0;
    // Format number as currency (you can customize this)
    document.getElementById('ntotal').value = addRupiah(subtotal + shipping);
    document.getElementById('nshipp_cost').value = addRupiah(shipping);
}

function printData(url) {
    // Get the id value from the hidden input in the form
    var idInput = document.querySelector('input[name="id"]');
    if (!idInput) {
        alert('ID not found');
        return;
    }
    var id = idInput.value;
    var cLink = url + id;
    window.open(cLink, "_blank", "menubar=no,location=no,status=yes,toolbar=no,directoris=no,scrollbars=yes,resizable=yes,top=100,left=500,width=1000,height=750");
}
</script>
@endsection
