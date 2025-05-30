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
                    <button type="button" onclick='save_check();' id='btn-save1' class="btn btn-primary btn-sm waves-effect waves-light">
                        <i class="mdi mdi-content-save"></i> Save
                    </button>
                    <a href="/inventory/mutin" type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-redo-variant"></i> Back</a>
                </div>
            </div><!-- end card header -->
            <div wire:ignore>
            <form class="form-horizontal"  method="POST" id="input-form" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        {!! MyHelper::setAlert() !!}
                        {!! MyHelper::setSpinner() !!}
                        <!-- start header -->
                        <div class="col-lg-6">
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
                                        <input class="form-check-input" type="radio" name="gridRadios" id="otRadios" value="OTH" checked>
                                        <label class="form-check-label" for="qoRadios">
                                            OTHER
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="ioRadios" value="MOT">
                                        <label class="form-check-label" for="ioRadios">
                                            MOT
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="qoRadios" value="PO">
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
                                        @foreach ($region as $c)
                                            <option value="{{ $c->id }}">{{ ucfirst($c->id.' - '.$c->cname) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row mb-3">
                                <label for="cno_mutation" class="col-sm-3 col-form-label text-end">MIN Number</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="cno_mutation" name="cno_mutation" value="{{ $no_mutation }}"
                                        placeholder="Enter Internal Order" readonly>
                                </div>
                                <label for="cstatus" class="col-sm-2 col-form-label text-center">Status</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control text-center" name="cstatus"  value="{{ MyHelper::_getstatus('O') }}" placeholder="Status" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="cshipment" class="col-sm-3 col-form-label text-end">Mutation Code </label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="cno_order" name="cno_order"  placeholder="Enter PO / MOT Number">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="ndst_region" class="col-sm-3 col-form-label text-end">To</label>
                                <div class="col-sm-6">
                                    <select class="form-select" name='ndst_region' id = 'ndst_region'>
                                        <option value="">Select Region</option>
                                        @foreach ($region as $c)
                                            <option value="{{ $c->id }}">{{ ucfirst($c->id.' - '.$c->cname) }}</option>
                                        @endforeach
                                    </select>
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
                            <div class="row mb-3">
                                <label for="ntotal" class="col-sm-2 col-form-label text-end">Sender </label>
                                <div class="col-sm-6">
                                    <input class="form-control" list="rowdata" name="csender" id="csender"  placeholder="Type to search...">
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
                                    <input class="form-control" list="rowdata" name="crecipient" id="crecipient"   onkeyup="this.value=toUCword(this.value);" placeholder="Type to search...">
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
                                <label for="ntotal" class="col-sm-3 col-form-label text-end">Sub Total </label>
                                <div class="col-sm-4">
                                    <input readonly type="text" class="form-control text-end bg-light" name="nsub_total" id="nsub_total" placeholder="Sub Total">
                                </div>
                            </div>
                            <div class="row mb-3 justify-content-end">
                                <label for="ntotal" class="col-sm-3 col-form-label text-end">Shipping Cost </label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control text-end" name="nshipp_cost" id="nshipp_cost" onkeyup="calculateMOT();" value='0' placeholder="Shipping Cost">
                                </div>
                            </div>
                            <div class="row mb-3 justify-content-end">
                                <label for="ntotal" class="col-sm-3 col-form-label text-end">Total Item </label>
                                <div class="col-sm-4">
                                    <input readonly type="text" class="form-control text-end bg-light" name="ntotal" id="ntotal" placeholder="Total">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end footer -->
                </div>
                <div class="card-footer float-end">
                    <button type="button" onclick='save_check();' id='btn-save2' class="btn btn-primary btn-sm waves-effect waves-light">
                        <i class="mdi mdi-content-save"></i> Save
                    </button>
                    <a href="/inventory/mutin" type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-redo-variant"></i> Back</a>
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
                    <td>
                        <input type="text" class="form-control text-center form-control-sm qty-add"
                            onkeydown="if(event.keyCode==13){event.preventDefault();return false;} if(!((event.keyCode>=48 && event.keyCode<=57) || (event.keyCode>=96 && event.keyCode<=105) || event.keyCode==8 || event.keyCode==37 || event.keyCode==39 || event.keyCode==46)){event.preventDefault();}"
                            name="icode[${ctr}][qty]" data-price="${data.rprice.replace(/,/g, '')}" value="1">
                    </td>
                    <td><input readonly type="text" class="form-control bg-light form-control-sm" name="icode[${ctr}][uom]" value="${data.runit}"></td>
                    <td><input readonly type="text" class="form-control text-end bg-light form-control-sm" name="icode[${ctr}][price]" value="${data.rprice}"></td>
                    <td class="text-center"><button class="btn btn-sm btn-icon btn-warning remove_field"><i class="mdi mdi-delete-empty"></i></button></td>
                </tr>
            `;
                        // Check if item_code already exists
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
            nsub_total.value = addRupiah(total);
            calculateMOT();
        });
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        const price = parseFloat($(this).closest('tr').find('input[name^="icode"][name$="[price]"]').val().replace(/,/g, '')) || 0;
        total -= price;
        nsub_total.value = addRupiah(total);
        calculateMOT();
        //console.log(total);
        ctr--; no--;
        e.preventDefault(); $(this).closest('tr').remove();
    });
}); // end document ready

// Use event delegation for dynamically added .qty-add inputs
document.querySelector('.input_fields_wrap').addEventListener('input', function(e) {
    if (e.target && e.target.classList.contains('qty-add')) {
        calculateMOT();
    }
});

function calculateMOT() {
    let total = 0;
    document.querySelectorAll('.qty-add').forEach(input => {
        if (!input.disabled && input.offsetParent !== null) { // check if enabled and visible
            const qty = parseFloat(input.value) || 0;
            const price = parseFloat(input.dataset.price) || 0;
            total += qty * price;
        }
    });
    const stotal = document.getElementById('nsub_total');
    if (stotal) {
        stotal.value = addRupiah(total);
    }

    const subtotal = parseFloat(document.getElementById('nsub_total').value.replace(/,/g, '')) || 0;
    const shipping = parseFloat(document.getElementById('nshipp_cost').value.replace(/,/g, '')) || 0;
    // Format number as currency (you can customize this)
    document.getElementById('ntotal').value = addRupiah(subtotal + shipping);
    document.getElementById('nshipp_cost').value = addRupiah(shipping);
}

function save_check(){
    const url = "/inventory/rwdata/misave", href= "/inventory/mutin";
    save_data(url,href)
}
</script>
@endsection
