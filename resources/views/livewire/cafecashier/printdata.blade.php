@section('title')
    {{ $pageTitle }}
@endsection
@section('page-title')
    {{ $pageDescription }}
@endsection
<div>
<pre>
==============================
{{ $profile->ctitle }}
==============================
Tanggal: {{ now() }}
Cashier: {{ $dtheader->ccashier }}
------------------------------
Item   Qty   Harga   Total
------------------------------
@foreach ($dtdetail as $item)
{{ $no++ }} {!! $item->citem_name !!}
    {{ $item->nqty }} * {{ number_format($item->nprice) }}{{ str_pad(number_format($item->ntotal), 13, " ", STR_PAD_LEFT) }}
@endforeach
------------------------------
Sub Total{{ str_pad(number_format($dtheader->nsub_total), 18, " ", STR_PAD_LEFT) }}
PPN      {{ str_pad(number_format($dtheader->ntot_ppn), 18, " ", STR_PAD_LEFT) }}
Total    {{ str_pad(number_format($dtheader->ntotal), 18, " ", STR_PAD_LEFT) }}
==============================
@if ($this->status=='O')
Waiting To Pay
Payment Rp. {{ str_pad(number_format($dtheader->nremaining), 18, " ", STR_PAD_LEFT) }}
@else
Payment  {{ str_pad(number_format($dtheader->npayment), 18, " ", STR_PAD_LEFT) }}
Return   {{ str_pad(number_format($dtheader->nremaining), 18, " ", STR_PAD_LEFT) }}
@endif
==============================
Terima Kasih!
</pre>
<button class="btn btn-warning btn-sm text-end" wire:click="printReceipt" >Cetak Struk</button>
<script>
    window.addEventListener('print-receipt', () => {
        window.print();
    });
</script>
</div>
