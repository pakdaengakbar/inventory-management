
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
    const url = "/sales/rwdata/svupdate", href= "/sales/service";
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
    // check customer
    const customerId = document.querySelector("#ncustomer_id");
    if (customerId.value == null || customerId.value=="") {
        viewAlert('Error, Please Search Customer..!');
        return;
    }
    update_data(url,href)
}
