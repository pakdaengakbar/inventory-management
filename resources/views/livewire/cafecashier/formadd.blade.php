@section('title')
    {{ $pageTitle }}
@endsection
@section('page-title')
    {{ $pageDescription }}
@endsection
<div>
<!-- Start Content-->
<div class="container-fluid">
<form method="POST" id="input-form" enctype="multipart/form-data">
    <div class="row">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-header">
                    {!! MyHelper::setAlert() !!}
                    {!! MyHelper::setSpinner() !!}
                    <div class="float-start d-flex justify-content-center">
                        <div class="row">
                            <label for="ccustomer_name" class="col-sm-4 col-form-label text-end">Customer</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="ccustomer_name" name="ccustomer_name"
                                        placeholder="Enter Customer Name"
                                        onkeyup="this.value=toUCword(this.value);">
                            </div>
                        </div>
                    </div>
                    <div class="row text-end">
                        <label class="col-sm-6 col-form-label text-end">Table</label>
                        <div class="col-sm-4">
                            <select class="form-select" id="corder_num" name="corder_num" >
                                <option value="">Select Table</option>
                                @forelse ($table as $trow)
                                    <option value="{{ $trow->ccode }}">{{ $trow->cname }}</option>
                                @empty
                                    <option value="">Data Empty</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#navpills-home" role="tab">
                                <span class="d-block d-sm-none"><i class="mdi mdi-food"></i></span>
                                <span class="d-none d-sm-block">Food</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#navpills-profile" role="tab">
                                <span class="d-block d-sm-none"><i class="mdi mdi-cup"></i></span>
                                <span class="d-none d-sm-block">Drink</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#navpills-messages" role="tab">
                                <span class="d-block d-sm-none"><i class="mdi mdi-food-variant"></i></span>
                                <span class="d-none d-sm-block">Passtry</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane active show" id="navpills-home" role="tabpanel">
                            <div class="row mb-3 justify-content-left">
                                <label for="ntotal" class="col-sm-1 col-form-label text-end fs-9">Search</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control fs-9" id="search_menu" placeholder="Example : Beef">
                                </div>
                            </div>
                            <div class="row row-cols-1 row-cols-md-3 row-cols-xl-6">
                                @forelse ($food as $frow)
                                <div class="col mb-2 food-card">
                                    <div class="card h-100">
                                        <img src="{{ asset($url_img.'products/'.$frow->iPhoto) }}" class="card-img-top rounded-top" alt="grid card">
                                        <div class="card-body" style="max-height: 18rem;">
                                            <h6 class="card-subtitle text-muted d-none" name='item[{{ $no++ }}][iID]'>{{ $frow->citem_code }}</h6>
                                            <h6 class="col-form-title fs-10 text-danger" name='item[{{ $no }}][iPrice]'>{{ number_format($frow->nretail_sell_price, 0, ',', '.') }}</h6>
                                            <h6 class="card-subtitle text-muted fs-10" name='item[{{ $no }}][iitem_name]'>{{ ucwords(strtolower($frow->citem_name)) }}</h6>
                                        </div>
                                        <p>
                                            <div class="input-group mb-1">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <a href="javascript:;" onclick='iDelete(<?= $no;?>);' class='text-danger'><i class="mdi mdi-minus"></i></a>
                                                </span>
                                                <input type="text" class="form-control text-center fs-12" id="iOrder{{ $no }}" name="item[{{ $no }}][iQty]" value='0'>
                                                <span class="input-group-text" id="basic-addon2">
                                                    <a href="javascript:;" onclick='iInsert(<?= $no;?>);' class='text-primary'><i class="mdi mdi-plus"></i></a>
                                                </span>
                                            </div>
                                            <a href="javascript:;" type="button" class="btn btn-primary btn-sm" id='add_item[{{ $no }}]'><i class="mdi mdi-plus"></i> Add Item</a>
                                        </p>
                                    </div>
                                </div>
                                @empty
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Empty Row Data
                                </div>
                                @endforelse
                            </div>
                        </div><!-- end tab pane -->
                        <div class="tab-pane" id="navpills-profile" role="tabpanel">
                            <div class="row mb-3 justify-content-left">
                                <label for="ntotal" class="col-sm-1 col-form-label text-end fs-9">Search</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control fs-9" id="search_drink" placeholder="Example : Vanilla">
                                </div>
                            </div>
                            <div class="row row-cols-1 row-cols-md-3 row-cols-xl-6">
                                @forelse ($drink as $drow)
                                <div class="col mb-2 drink-card">
                                    <div class="card h-100">
                                        <img src="{{ asset($url_img.'products/'.$drow->iPhoto) }}" class="card-img-top rounded-top" alt="grid card">
                                        <div class="card-body" style="max-height: 18rem;">
                                            <h6 class="card-subtitle text-muted d-none" name='item[{{ $no++ }}][iID]'>{{ $drow->citem_code }}</h6>
                                            <h6 class="col-form-title fs-10 text-danger" name='item[{{ $no }}][iPrice]'>{{ number_format($drow->nretail_sell_price, 0, ',', '.') }}</h6>
                                            <h6 class="card-subtitle text-muted fs-10" name='item[{{ $no }}][iitem_name]'>{{ ucwords(strtolower($drow->citem_name)) }}</h6>
                                        </div>
                                        <p>
                                            <div class="input-group mb-1">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <a href="javascript:;" onclick='iDelete(<?= $no;?>);' class='text-danger'><i class="mdi mdi-minus"></i></a>
                                                </span>
                                                <input type="text" class="form-control text-center fs-12" id="iOrder{{ $no }}" name="item[{{ $no }}][iQty]" value='0'>
                                                <span class="input-group-text" id="basic-addon2">
                                                    <a href="javascript:;" onclick='iInsert(<?= $no;?>);' class='text-primary'><i class="mdi mdi-plus"></i></a>
                                                </span>
                                            </div>
                                            <a href="javascript:;" type="button" class="btn btn-primary btn-sm" id='add_item[{{ $no }}]'><i class="mdi mdi-plus"></i> Add Item</a>
                                        </p>
                                    </div>
                                </div>
                                @empty
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Empty Row Data
                                </div>
                                @endforelse
                            </div>
                        </div><!-- end tab pane -->
                        <div class="tab-pane" id="navpills-messages" role="tabpanel">
                            <div class="row mb-3 justify-content-left">
                                <label for="ntotal" class="col-sm-1 col-form-label text-end fs-9">Search</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control fs-9" id="search_package" placeholder="Example : Red Velvet">
                                </div>
                            </div>
                            <div class="row row-cols-1 row-cols-md-3 row-cols-xl-6">
                                @forelse ($package as $prow)
                                <div class="col mb-2 package-card">
                                    <div class="card h-100">
                                        <img src="{{ asset($url_img.'products/'.$prow->iPhoto) }}" class="card-img-top rounded-top" alt="grid card">
                                        <div class="card-body" style="max-height: 18rem;">
                                            <h6 class="card-subtitle text-muted d-none" name='item[{{ $no++ }}][iID]'>{{ $prow->citem_code }}</h6>
                                            <h6 class="col-form-title fs-10 text-danger" name='item[{{ $no }}][iPrice]'>{{ number_format($prow->nretail_sell_price, 0, ',', '.') }}</h6>
                                            <h6 class="card-subtitle text-muted fs-10" name='item[{{ $no }}][iitem_name]'>{{ ucwords(strtolower($prow->citem_name)) }}</h6>
                                        </div>
                                        <p>
                                            <div class="input-group mb-1">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <a href="javascript:;" onclick='iDelete(<?= $no;?>);' class='text-danger'><i class="mdi mdi-minus"></i></a>
                                                </span>
                                                <input type="text" class="form-control text-center fs-12" id="iOrder{{ $no }}" name="item[{{ $no }}][iQty]" value='0'>
                                                <span class="input-group-text" id="basic-addon2">
                                                    <a href="javascript:;" onclick='iInsert(<?= $no;?>);' class='text-primary'><i class="mdi mdi-plus"></i></a>
                                                </span>
                                            </div>
                                            <a href="javascript:;" type="button" class="btn btn-primary btn-sm" id='add_item[{{ $no }}]'><i class="mdi mdi-plus"></i> Add Item</a>
                                        </p>
                                    </div>
                                </div>
                                @empty
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Empty Row Data
                                </div>
                                @endforelse
                            </div>
                        </div><!-- end tab pane -->
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-header">
                   <div class="float-start d-flex justify-content-center">
                        <h5 class="card-title mb-0 caption fw-semibold fs-18">No.Invoice</h5>
                    </div>
                    <div class="float-end">
                        <h5 id='txtFaktur' class='text-danger'>{{ $cno_faktur }}</h5>
                    </div>
                </div><!-- end card header -->
                <div wire:ignore>
                    <div class="card-body">
                        <div class="row">
                            <table id="itemDTatable" class="table table-bordered dt-responsive nowrap">
                                <thead class='fs-10'>
                                    <tr>
                                        <th>Name</th>
                                        <th>Total</th>
                                        <th class="col-1 text-center">Del</th>
                                    </tr>
                                </thead>
                                <tbody class="input_fields_wrap fs-10"></tbody>
                            </table>
                            <hr>
                            <div class="row mb-3 justify-content-end">
                                <label for="ntotal" class="col-sm-4 col-form-label text-end fs-9"><b>Sub Total</b></label>
                                <div class="col-sm-8">
                                    <input readonly type="text" class="form-control text-end bg-light fs-10" name="nsub_total" id="nsub_total" placeholder="Sub Total" value='0'>
                                </div>
                            </div>
                            @if ($fee_on==true)
                            <div class="row mb-3 justify-content-end">
                                <label for="nfee" class="col-sm-4 col-form-label text-end fs-9"><b>Fee [%]</b></label>
                                <div class="col-sm-3">
                                    <input maxlength='2' readonly type="text" class="form-control text-center bg-light fs-10" name="nfee" id="nfee" value='{{ $fee }}' placeholder="Fee">
                                </div>
                                <div class="col-sm-5">
                                    <input readonly type="text" class="form-control text-end bg-light fs-10" name="ntot_fee" id="ntot_fee" placeholder="Total Fee"value='0'>
                                </div>
                            </div>
                            @endif
                            <div class="row mb-3 justify-content-end">
                                <label for="nppn" class="col-sm-3 col-form-label text-end fs-9"><b>PPN [%]</b></label>
                                <div class="col-sm-3">
                                    <input maxlength='2' readonly type="text" class="form-control text-center bg-light fs-10" name="nppn" id="nppn" value='{{ $ppn }}' placeholder="Ppn">
                                </div>
                                <div class="col-sm-5">
                                    <input readonly type="text" class="form-control text-end bg-light fs-10" name="ntot_ppn" id="ntot_ppn" placeholder="Total PPN"value='0'>
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-end">
                                <label for="ndisc" class="col-sm-4 col-form-label text-end fs-9"><b>Disc. [%]</b></label>
                                <div class="col-sm-3">
                                    <input maxlength='2' onkeyup="calculateOrder();" onblur='checkDisc();' type="text" class="form-control text-center fs-10" name="ndisc" id="ndisc" value='0' placeholder="Discount">
                                </div>
                                <div class="col-sm-5">
                                    <input readonly type="text" class="form-control text-end bg-light fs-10" name="ntot_disc" id="ntot_disc" placeholder="Total Discount"value='0'>
                                </div>
                            </div>
                            <div class="row mb-3 justify-content-end">
                                <label for="ntotal" class="col-sm-4 col-form-label text-end fs-9"><b>Total Item</b></label>
                                <div class="col-sm-8">
                                    <input readonly type="text" class="form-control text-end bg-light fs-10" name="ntotal" id="ntotal" placeholder="Total" value='0'>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3 justify-content-end">
                                <label for="ntotal" class="col-sm-4 col-form-label text-end fs-9">Payment </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control text-end fs-10" name="npayment" id="npayment" onkeydown='paymentEvent(event);' onkeyup="calculatePay(this);" placeholder="Payment" value='0'>
                                </div>
                            </div>
                            <div class="row mb-3 justify-content-end">
                                <label for="ntotal" class="col-sm-4 col-form-label text-end fs-9">Remaining </label>
                                <div class="col-sm-8">
                                    <input readonly type="text" class="form-control text-end bg-light fs-10" name="nremaining" id="nremaining" placeholder="Remaining" value='0'>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer float-end text-end">
                    <a href="javascript:;" onclick='save_order();' id='btn-save1' type="button" class="btn btn-success waves-effect waves-light btn-sm">
                        <i class="mdi mdi-content-save"></i> Save</a>
                    <a href="javascript:;" onclick='save_payment();' id='btn-save3' type="button" class="btn btn-primary waves-effect waves-light btn-sm">
                        <i class="mdi mdi-printer-check"></i> Payment</a>
                    <a href="/cafe/cashiers" type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-redo-variant"></i> Cancel</a>
                </div>
            </div>
        </div>
    </div>
</form>
</div> <!-- container-fluid -->

<!-- modal -->
@include('livewire.trinternalord.prodsearch');
@include('livewire.trsaleservice.custsearch');
</div>

@section('script')
<script>
// Use emit inside Livewire-ready event
document.addEventListener('DOMContentLoaded', function () {
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    hiddenSidebar();

    const btn_additem = document.querySelectorAll('[id^="add_item["]');
    const wrapper = document.querySelector('.input_fields_wrap');
    let ctr = 0, no = 0, stotal = 0, total = 0;

    btn_additem.forEach(function(btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            ctr++; no++;
            if (ccustomer_name.value == ''){
                viewAlert('Error, Customer Name empty ! ');
                $("#ccustomer_name").focus();
                return false;
            }
            if (corder_num .value == ''){
                viewAlert('Error, Table empty ! ');
                $("#corder_num ").focus();
                return false;
            }

            // Get the price value from the selected card's iPrice element
            const card = e.target.closest('.card');
            const priceElem = card.querySelector('[name^="item"][name$="[iPrice]"]');
            const data = {};

            data.price = priceElem ? priceElem.textContent.replace(/[^0-9.,]/g, '').replace(/\./g, '').trim() : '0';
            data.icode = card.querySelector('[name^="item"][name$="[iID]"]')?.textContent.trim() || '';
            data.iname = card.querySelector('[name^="item"][name$="[iitem_name]"]')?.textContent.trim() || '';
            data.iqty  = card.querySelector('[name^="item"][name$="[iQty]"]')?.value || '';
            // Now use data.price in your row template
            stotal = data.iqty * data.price;
            svalue = addRupiah(stotal);
            const row = `
                <tr>
                    <td hidden>
                        ${data.icode}
                        <input type="hidden" name="icode[${ctr}][iID]" value="${data.icode}">
                        <input type="hidden" name="icode[${ctr}][iprice]" value="${data.price}">
                    </td>
                    <td>
                        ${data.iname} [ ${data.iqty} * ${addRupiah(data.price)} ]
                        <input type="hidden" name="icode[${ctr}][item_name]" value="${data.iname}">
                    </td>
                    <td  class='text-center' hidden>
                        ${data.iqty}
                        <input type="hidden" name="icode[${ctr}][iqty]" value="${data.iqty}">
                    </td>
                    <td class='text-end'>
                        ${svalue}
                        <input type="hidden" name="icode[${ctr}][itotal]" value="${svalue}">
                    </td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-icon btn-warning remove_field"><i class="mdi mdi-delete-empty"></i></button>
                    </td>
                </tr>
            `;
            // Check if item_code already exists
           let found = false;
            wrapper.querySelectorAll('input[name^="icode"][name$="[iID]"]').forEach(function(inputID) {
                if (inputID.value === data.icode) {
                    // Get the parent <tr> from the hidden input
                    let row = inputID.closest('tr');
                    // Select the related inputs in the same row
                    let qtyInput   = row.querySelector('input[name^="icode"][name$="[iqty]"]');
                    let nameInput  = row.querySelector('input[name^="icode"][name$="[item_name]"]');
                    let totalInput = row.querySelector('input[name^="icode"][name$="[itotal]"]');
                    if (qtyInput) {
                        let currentQty = parseInt(qtyInput.value) || 0;
                        let newQty = currentQty + parseInt(data.iqty || 1);
                        qtyInput.value = newQty;
                        // Update displayed quantity (outside input, if needed)
                        row.querySelector('td:nth-child(3)').childNodes[0].nodeValue = newQty;
                        // Update display name (visible) + hidden value (optional)
                        row.querySelector('td:nth-child(2)').childNodes[0].nodeValue =
                            `${data.iname} [ ${newQty} * ${addRupiah(data.price)} ]`;
                        // Update hidden input if needed
                        nameInput.value = data.iname;
                        // Update total
                        let total = newQty * parseFloat(data.price);
                        totalInput.value = total;
                        row.querySelector('td:nth-child(4)').childNodes[0].nodeValue = addRupiah(total);
                        found = true;
                    }
                }
            });

            if (!found) {
                wrapper.insertAdjacentHTML('beforeend', row);
            }
            // Reset the quantity input value to 0 after adding the row
            if (card.querySelector('[name^="item"][name$="[iQty]"]')) {
                card.querySelector('[name^="item"][name$="[iQty]"]').value = 0;
            }

            let sub_total= parseFloat(document.getElementById('nsub_total').value.replace(/,/g, '')) || 0;
            sub_total += Number(stotal);
            nsub_total.value = addRupiah(sub_total);
            calculateOrder();
            pageScrollUp();
        });
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        let qty   = parseFloat($(this).closest('tr').find('input[name^="icode"][name$="[iqty]"]').val().replace(/,/g, '')) || 0;
        let price = parseFloat($(this).closest('tr').find('input[name^="icode"][name$="[iprice]"]').val().replace(/,/g, '')) || 0;
        let sub_total= parseFloat(document.getElementById('nsub_total').value.replace(/,/g, '')) || 0;

        stotal = qty*price;
        sub_total -= Number(stotal);
        nsub_total.value = addRupiah(sub_total);
        //console.log(total);
        ctr--; no--;
        e.preventDefault(); $(this).closest('tr').remove();
        calculateOrder();
    });
    // food serach
    const searchInput = document.getElementById('search_menu');
    const foodCards   = document.querySelectorAll('.food-card');
    searchInput.addEventListener('change', function() {
        const searchValue = this.value.toLowerCase();
        foodCards.forEach(function(card) {
            const nameElem = card.querySelector('[name$="[iitem_name]"]');
            const itemName = nameElem ? nameElem.textContent.toLowerCase() : '';
            if (itemName.includes(searchValue)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
    // drink serach
    const searchDrink = document.getElementById('search_drink');
    const drinkCards   = document.querySelectorAll('.drink-card');
    searchDrink.addEventListener('change', function() {
        const searchValue = this.value.toLowerCase();
        drinkCards.forEach(function(card) {
            const nameElem = card.querySelector('[name$="[iitem_name]"]');
            const itemName = nameElem ? nameElem.textContent.toLowerCase() : '';
            if (itemName.includes(searchValue)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
    // package serach
    const searchPackage = document.getElementById('search_package');
    const drinkPackage   = document.querySelectorAll('.package-card');
    searchPackage.addEventListener('change', function() {
        const searchValue = this.value.toLowerCase();
        drinkPackage.forEach(function(card) {
            const nameElem = card.querySelector('[name$="[iitem_name]"]');
            const itemName = nameElem ? nameElem.textContent.toLowerCase() : '';
            if (itemName.includes(searchValue)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
// end document ready cashier cafee
// calculate order caffe
function calculateOrder() {
    let tmpTotal = 0, tmpStotal = 0, tmpDisc = 0, tmpFee = 0;
    //ntotal npayment nremaining ntot_ppn nppn
    const fee       = parseFloat(document.getElementById('nfee').value.replace(/,/g, '')) || 0;
    const ppn       = parseFloat(document.getElementById('nppn').value.replace(/,/g, '')) || 0;
    const disc      = parseFloat(document.getElementById('ndisc').value.replace(/,/g, '')) || 0;
    const stotal    = parseFloat(document.getElementById('nsub_total').value.replace(/,/g, '')) || 0;
    const payment   = parseFloat(document.getElementById('npayment').value.replace(/,/g, '')) || 0;
    // count fee
    totFee = Math.ceil((stotal*fee)/100);
    ntot_fee.value  = addRupiah(totFee);
    tmpFee = stotal + totFee;
    // count ppn
    totPpn = Math.ceil((tmpFee*ppn)/100);
    ntot_ppn.value  = addRupiah(totPpn);
    tmpStotal = tmpFee + totPpn;
    // count dicount
    tmpDisc  = Math.ceil((tmpStotal*disc)/100);
    tmpTotal = tmpStotal-tmpDisc;
    ntot_disc.value  = addRupiah(tmpDisc);
    // count total
    ntotal.value     = addRupiah(tmpTotal);
    nremaining.value = addRupiah(tmpTotal - payment);

    search_menu.value = "";
    search_drink.value= "";
}
// discount check
function checkDisc(){
    if (ndisc.value==''){
        ndisc.value = 0;
        calculateOrder();
    }
}
// payment event
function paymentEvent(event) {
    if (event.keyCode === 13) { // 13 is Enter
        event.preventDefault();
        document.querySelector('#btn-save2').click();
    }
}
function calculatePay(tpayment) {
    const payment   = parseFloat(tpayment.value.replace(/,/g, '')) || 0;
    tpayment.value = addRupiah(payment);
    calculateOrder();
}
// save transaction
function save_order(){
    const url = "/cafe/rwdata/casave", href= "/cafe/cashiers";
     if (ccustomer_name.value == ''){
        viewAlert('Error, Customer Name empty ! ');
        pageScrollUp();
        $("#ccustomer_name").focus();
        return false;
    }
    save_data(url,href)
}
function save_payment(){
    const url = "/cafe/rwdata/casave", href= "/cafe/cashiers";
    const total   = parseFloat(document.getElementById('ntotal').value.replace(/,/g, '')) || 0;
    const payment = parseFloat(document.getElementById('npayment').value.replace(/,/g, '')) || 0;
    // check payment
    if (payment.value == 0 || payment.value=="") {
        viewAlert('Error, Payment Empty..! ');
        pageScrollUp();
        $("#npayment").focus();
        return false;
    }
    if (total > payment){
        viewAlert('Error, Underpayment..! ');
        pageScrollUp();
        $("#npayment").focus();
        return false;
    }
    // check customer
     if (ccustomer_name.value == ''){
        viewAlert('Error, Customer Name empty ! ');
        pageScrollUp();
        $("#ccustomer_name").focus();
        return false;
    }
    save_data(url,href)
}
// add order qty
function iInsert(i){
    const tInput = document.getElementById('iOrder' + i);
    let t = parseFloat(tInput ? tInput.value.replace(/,/g, '') : 0) || 0;
	t = t+1;
    tInput.value = t;
}
function iDelete(i){
    const tInput = document.getElementById('iOrder' + i);
    let t = parseFloat(tInput ? tInput.value.replace(/,/g, '') : 0) || 0;
	if (t > 0){t = t-1;}
	tInput.value = t;
}
</script>
@endsection
