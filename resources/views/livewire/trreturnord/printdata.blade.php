@section('title')
    {{ $pageTitle }}
@endsection
@section('page-title')
    {{ $pageDescription }}
@endsection
<div>
    <div class="container-fluid">
        {!! $pageBreadcrumb !!}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="panel-body">
                            <div class="clearfix">
                                <div class="float-start d-flex justify-content-center">
                                    <img src="{{ asset($url_img.'profile/'.$profile->clogo) }}" class="me-2" alt="logo" height="26">
                                    <h4 class="mb-0 caption fw-semibold fs-18">{{ $profile->cname }}<br>
                                        <strong class="fs-15 fw-normal">Date : {{ date('M d Y') }} </strong>
                                    </h4>
                                </div>
                                <div class="float-end">
                                    <h4 class="fs-18">#{{ $dtheader->cno_delivery }}<br>
                                        <strong class="fs-15 fw-normal">Delivery Order</strong>
                                    </h4>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="float-start mt-3">
                                        <address>
                                            <strong>Sender :</strong><br>
                                            <strong>{{ $dtheader->csender }}</strong><br>
                                            <span> {!! $dtheader->cnotes !!} </span><br>
                                            <span>#Reff : {!! $dtheader->cno_faktur !!} </span>
                                       </address>
                                    </div>
                                    <div class="float-end mt-3 col-md-3">
                                        <address>
                                            <strong>Recipient :</strong><br>
                                            <strong>{{ $dtheader->crecipient }}</strong><br>
                                            {{ $dtheader->region->cname }}<br>
                                            {{ $dtheader->region->caddress1 }}<br>
                                            <abbr title="Phone">P:</abbr> {{ $dtheader->region->cphone }}
                                        </address>
                                    </div>
                                </div>
                            </div>
                            <hr>
                             <div class="row">
                                <div class="col-xl-3">
                                    <p class="mb-1 fw-semibold">Expedition :</p>
                                    <p class="mb-1">#{{ $dtheader->expedition->cname }} </p>
                                </div>

                                <div class="col-xl-3">
                                    <p class="mb-1 fw-semibold">Shipment Num. :</p>
                                    <p class="mb-1">{{ $dtheader->cshipment }}</p>
                                </div>

                                <div class="col-xl-3">
                                    <p class="mb-1 fw-semibold">Sender :</p>
                                    <p class="mb-1">{{ $dtheader->csender }}</p>
                                </div>

                                <div class="col-xl-3">
                                    <p class="mb-1 fw-semibold">Recipient :</p>
                                    <p class="mb-1">{{ $dtheader->crecipient }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive rounded-2">
                                        <table class="table mt-4 mb-4 table-centered border">
                                            <thead class="rounded-2">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Item</th>
                                                    <th>Description</th>
                                                    <th class='text-center'>Quantity</th>
                                                    <th class='text-end'>Price</th>
                                                    <th class='text-end'>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($dtdetail as $row)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $row->citem_code }}</td>
                                                    <td>{{ $row->citem_name }}</td>
                                                    <td class='text-center'>{{ $row->nqty }}</td>
                                                    <td class='text-end'>{{ number_format($row->nprice) }}</td>
                                                    <td class='text-end'>{{ number_format($row->nqty*$row->nprice) }}</td>
                                                </tr>
                                                @empty
                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        Empty Row Data
                                                    </div>
                                                @endforelse
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4"></td>
                                                    <td colspan="2">
                                                        <table class="table table-sm text-nowrap mb-0 table-borderless">
                                                            <tbody>
                                                                <tr>
                                                                    <td scope="row">
                                                                        <p class="mb-0 fs-14">Total :</p>
                                                                    </td>
                                                                    <td class='text-end'>
                                                                        <p class="mb-0 fw-medium fs-16 text-success">{{ number_format($dtheader->ntotal) }}</p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="float-start mt-3">
                                        <address>
                                            <strong class=''>Create By :</strong><br>
                                            <span class='mb-2 d-block'>Date : {{ $dtheader->dtrans_date }}</span><br>
                                            <span class='mt-3 d-block'>{{ $dtheader->ccashier }}</span>
                                        </address>
                                    </div>
                                    <div class="float-end mt-3">
                                        <address>
                                            <strong>Approve By : </strong><br>
                                            <span>Date : {{ $dtheader->capp_date }}</span><br>
                                            @if(isset($dtheader->capprove))
                                                <img src="{{ asset($app_img) }}" alt="approved" height="45px">
                                            @else
                                                <span class='mb-3 d-block'>-</span>
                                            @endif
                                            <span class='mt-1 d-block'>{{ isset($dtheader->capprove)  ? $dtheader->capprove : "not yet approved"  }}</span>
                                        </address>
                                    </div>
                                </div>
                            </div>
                            <div class="d-print-none">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-dark border-0"><i class="mdi mdi-printer me-1"></i>Print</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
</div>
