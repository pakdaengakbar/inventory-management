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
<form method="POST" id="input-form" enctype="multipart/form-data">
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start d-flex justify-content-center">
                         <h6 class="card-title mb-0 caption fw-semibold fs-9">Sub Total :</h6>
                    </div>
                    <div class="float-end">
                        <h5 id='txtTotal' class='text-danger'>Rp {{ number_format($dtheader['nsub_total']) }}</h5>
                    </div>
                </div><!-- end card header -->
                <div wire:ignore>
                <div class="card-body">
                    {!! MyHelper::setAlert() !!}
                    <div class="row mb-3 d-none">
                        <label for="ntotal" class="col-sm-1 col-form-label text-end">ID</label>
                        <div class="col-sm-1">
                            <input readonly type="text" class="form-control text-center bg-light" name="id"  id="id" value="{{ $dtheader['id'] }}">
                        </div>
                    </div>
                    @if ($dtheader['cstatus']=="O")
                    <div class="row mb-3 row-cols-lg-auto g-2 align-items-center" id='getDataItem'>
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
                            <button type="button" class="btn btn-success add_item btn-sm"><i class="mdi mdi-plus"></i>Add Item</button>
                        </div>
                    </div>
                    @endif
                    <table id="itemDTatable" class="table table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th class="col-1 text-center">No</th>
                                <th>Barcode</th>
                                <th>Item Name</th>
                                <th class="col-1">Qty</th>
                                <th class="col-1">Uom</th>
                                <th>Harga</th>
                                <th>Total</th>
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
                                    <td><input readonly type="text" class="form-control text-end bg-light form-control-sm"  name="icode[{{ $no }}][itotal]" value="{{ number_format($row->ntotal) }}"></td>
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
                </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <div class="float-start d-flex justify-content-center">
                        <h6 class="card-title mb-0 caption fw-semibold fs-9">Invoice No :</h6>
                    </div>
                    <div class="float-end">
                        <h5 id='txtFaktur' class='text-danger'>{{ $dtheader['cno_faktur'] }}</h5>
                    </div>
                </div><!-- end card header -->
                <div wire:ignore>
                    <div class="card-body">
                        <div class="row">
                            <div class="row mb-3 justify-content-end">
                                <label for="ntotal" class="col-sm-3 col-form-label text-end">Sub Total </label>
                                <div class="col-sm-6">
                                    <input readonly type="text" class="form-control text-end bg-light" name="nsub_total" id="nsub_total" value="{{ number_format($dtheader['nsub_total']) }}" placeholder="Sub Total" value='0'>
                                </div>
                            </div>
                            <div class="row mb-3 justify-content-end">
                                <label for="nppn" class="col-sm-2 col-form-label text-end">PPN </label>
                                <div class="col-sm-2">
                                    <input readonly type="text" class="form-control text-center bg-light" name="nppn" id="nppn" value="{{ $dtheader['nppn'] }}" placeholder="Ppn">
                                </div>
                                <div class="col-sm-6">
                                    <input readonly type="text" class="form-control text-end bg-light" name="ntot_ppn" id="ntot_ppn"  value="{{ number_format($dtheader['nsub_total']) }}"  placeholder="Total PPN"value='0'>
                                </div>
                            </div>
                            <div class="row mb-3 justify-content-end">
                                <label for="ntotal" class="col-sm-3 col-form-label text-end">Total Item </label>
                                <div class="col-sm-6">
                                    <input readonly type="text" class="form-control text-end bg-light" name="ntotal" id="ntotal" placeholder="Total"  value="{{ number_format($dtheader['ntotal']) }}" value='0'>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3 justify-content-end">
                                <label for="ntotal" class="col-sm-3 col-form-label text-end">Payment </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control text-end" name="npayment" id="npayment" onkeyup="calculatePay(this);" value="{{ number_format($dtheader['npayment']) }}" placeholder="Payment" value='0'>
                                </div>
                            </div>
                            <div class="row mb-3 justify-content-end">
                                <label for="ntotal" class="col-sm-4 col-form-label text-end">Remaining Change </label>
                                <div class="col-sm-6">
                                    <input readonly type="text" class="form-control text-end bg-light" name="nremaining" id="nremaining" value="{{ number_format($dtheader['nremaining']) }}" placeholder="Remaining" value='0'>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer float-end text-end">
                    @if ($dtheader['cstatus']=="O")
                    <button type="button" onclick='save_check();' id='btn-save2' class="btn btn-primary waves-effect waves-light btn-sm">
                        <i class="mdi mdi-content-save"></i> Save & Print
                    </button>
                    @endif
                    <a href="/sales/service" type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-redo-variant "></i> Cancel</a>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- modal -->
@include('livewire.trinternalord.prodsearch');
</div> <!-- container-fluid -->
</div>

@section('script')
<script>
// Use emit inside Livewire-ready event
document.addEventListener('DOMContentLoaded', function () {
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    // hidden sidebar
    hiddenSidebar();

    const btn_additem = document.querySelector('.add_item');
    const wrapper = document.querySelector('.input_fields_wrap');
    let ctr = 0, no = 0, total = 0;
    // Add item when pressing Enter in the barcode input
    document.querySelector("#barcode").addEventListener('keyup', function (e) {
        if (e.key === "Enter") {
            e.preventDefault();
            document.querySelector('.add_item').click();
        }
    });
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
                    <td><input readonly type="text" class="form-control bg-light form-control-sm" name="icode[${ctr}][barcode]" value="${data.barcode}"></td>
                    <td hidden><input readonly type="text" class="form-control bg-light form-control-sm" name="icode[${ctr}][item_code]" value="${data.icode}"></td>
                    <td><input readonly type="text" class="form-control bg-light form-control-sm" name="icode[${ctr}][item_name]" value="${data.iname}"></td>
                    <td>
                        <input type="text" class="form-control text-center form-control-sm"
                            onkeydown="if(event.keyCode==13){event.preventDefault();return false;} if(!((event.keyCode>=48 && event.keyCode<=57) || (event.keyCode>=96 && event.keyCode<=105) || event.keyCode==8 || event.keyCode==37 || event.keyCode==39 || event.keyCode==46)){event.preventDefault();}"
                            onkeyup='if(event.keyCode!=13){calculateRow(this); }'
                            name="icode[${ctr}][qty]" value="1">
                    </td>
                    <td><input readonly type="text" class="form-control bg-light form-control-sm" name="icode[${ctr}][uom]" value="${data.runit}"></td>
                    <td><input readonly type="text" class="form-control text-end bg-light form-control-sm" name="icode[${ctr}][price]" value="${data.rprice}"></td>
                    <td><input readonly type="text" class="form-control text-end bg-light form-control-sm" name="icode[${ctr}][itotal]"></td>
                    <td class="text-center"><button class="btn btn-sm btn-icon btn-warning remove_field"><i class="mdi mdi-delete-empty"></i></button></td>
                </tr>
            `;
            // Check if item_code already exists
            let found = false;
            wrapper.querySelectorAll('input[name^="icode"][name$="[item_code]"]').forEach(function(input) {
                if (input.value === data.icode) {
                    let qtyInput = input.closest('tr').querySelector('input[name^="icode"][name$="[qty]"]');
                    qtyInput.value = parseInt(qtyInput.value) + 1;
                    calculateRow(input);
                    found = true;
                }
            });
            // After inserting the new row, calculate the total for the new row
            if (!found) {
                wrapper.insertAdjacentHTML('beforeend', row);
                let lastRow = wrapper.querySelector('tr:last-child');
                if (lastRow) {
                    let input = lastRow.querySelector('input[name^="icode"][name$="[item_code]"]');
                    if (input) {
                        calculateRow(input);
                    }
                }
            }
            document.querySelector("#barcode").value = "";
            document.querySelector("#barcode").focus();

            const price = parseFloat(data.rprice.replace(/,/g, '')) || 0;
            total += price;
            nsub_total.value = addRupiah(total);
            calculateSO();
        });
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        const qty = parseFloat($(this).closest('tr').find('input[name^="icode"][name$="[qty]"]').val().replace(/,/g, '')) || 0;
        const price = parseFloat($(this).closest('tr').find('input[name^="icode"][name$="[price]"]').val().replace(/,/g, '')) || 0;
        total -= qty * price;
        nsub_total.value = addRupiah(total);
        calculateSO();
        //console.log(total);
        ctr--; no--;
        e.preventDefault(); $(this).closest('tr').remove();
    });

}); // end document ready mutout

function calculateRow(input) {
    let qtyInput   = input.closest('tr').querySelector('input[name^="icode"][name$="[qty]"]');
    let priceInput = input.closest('tr').querySelector('input[name^="icode"][name$="[price]"]');
    let totalInput = input.closest('tr').querySelector('input[name^="icode"][name$="[itotal]"]');
    //qtyInput.value = parseInt(qtyInput.value) + 1;
    // Calculate new total
    let qty   = parseInt(qtyInput.value) || 0;
    let price = parseFloat(priceInput.value.replace(/,/g, '')) || 0;
    totalInput.value = addRupiah(qty * price);

    // Recalculate subtotal after row update
    let wrapper = input.closest('tbody');
    let subtotal = 0;
    wrapper.querySelectorAll('input[name^="icode"][name$="[itotal]"]').forEach(function(itotalInput) {
        let val = parseFloat((itotalInput.value || '0').replace(/,/g, '')) || 0;
        subtotal += val;
    });
    document.getElementById('nsub_total').value = addRupiah(subtotal);
    document.getElementById('textSTotal').textContent = addRupiah(subtotal);
    calculateSO();
}

function calculateSO() {
    //ntotal npayment nremaining ntot_ppn nppn
    const ppn       = parseFloat(document.getElementById('nppn').value.replace(/,/g, '')) || 0;
    const stotal    = parseFloat(document.getElementById('nsub_total').value.replace(/,/g, '')) || 0;
    const payment   = parseFloat(document.getElementById('npayment').value.replace(/,/g, '')) || 0;
    // Format number as currency (you can customize this)
    totPpn = (stotal*ppn)/100;
    ntot_ppn.value  = addRupiah(totPpn);
    ntotal.value    = addRupiah(stotal + totPpn);
    //nremaining.value = addRupiah(Math.abs((stotal + totPpn) - payment));
    nremaining.value = addRupiah((stotal + totPpn) - payment);
    document.getElementById('textSTotal').textContent = addRupiah(stotal);
}

function calculatePay(tpayment) {
    const payment   = parseFloat(tpayment.value.replace(/,/g, '')) || 0;
    tpayment.value = addRupiah(payment);
    calculateSO();
}

function save_check(){
    const url = "/sales/rwdata/rtupdate", href= "/sales/retail";
    const total    = parseFloat(document.getElementById('ntotal').value.replace(/,/g, '')) || 0;
    const payment   = parseFloat(document.getElementById('npayment').value.replace(/,/g, '')) || 0;

    if (payment.value == 0 || payment.value=="") {
        viewAlert('Error, Payment Empty..! ');
        $("#npayment").focus();
        return;
    }

    if (total > payment){
        viewAlert('Error, Underpayment..! ');
        $("#npayment").focus();
        return;
    }
    update_data(url,href)
}
</script>
@endsection
