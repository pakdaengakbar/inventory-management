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
                                    <h4 class="fs-18">#{{ $dtheader->cno_po }}<br>
                                        <strong class="fs-15 fw-normal">Purchase Order</strong>
                                    </h4>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="float-start mt-3">
                                        <address>
                                            <strong>Purchase Order :</strong><br>
                                            {{ $dtheader->region->cname }}<br>
                                            {{ $dtheader->region->caddress1 }}<br>
                                            <abbr title="Phone">P:</abbr> {{ $dtheader->region->cphone }}
                                        </address>
                                    </div>
                                    <div class="float-end mt-3">
                                        <address>
                                            <strong>Supplier : </strong><br>
                                            <table>
                                                <tbody>
                                                <tr>
                                                    <td class="pe-3">Name</td>
                                                    <td class="pe-1">:</td>
                                                    <td>{{ $dtheader->supplier->cname }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pe-3">Address</td>
                                                    <td class="pe-1">:</td>
                                                    <td>{{ $dtheader->supplier->caddress }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pe-3">Phone</td>
                                                    <td class="pe-1">:</td>
                                                    <td>{{ $dtheader->supplier->cphone }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </address>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-xl-3">
                                    <p class="mb-1 fw-semibold">Invoice ID :</p>
                                    <p class="mb-1">#{{ $dtheader->csupplier_inv }} </p>
                                </div>

                                <div class="col-xl-3">
                                    <p class="mb-1 fw-semibold">Date Issued :</p>
                                    <p class="mb-1">{{ $dtheader->dtrans_date }}</p>
                                </div>

                                <div class="col-xl-3">
                                    <p class="mb-1 fw-semibold">Due Date :</p>
                                    <p class="mb-1">{{ $dtheader->ddue_date }}</p>
                                </div>

                                <div class="col-xl-3">
                                    <p class="mb-1 fw-semibold">Due Amount :</p>
                                    <p class="mb-1 fw-bold">{{ number_format($dtheader->ntotal) }}</p>
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
                                                    <td class='text-end'>{{ number_format($row->nretail_po_price) }}</td>
                                                    <td class='text-end'>{{ number_format($row->nqty*$row->nretail_po_price) }}</td>
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
                                                <tr>
                                                    <td colspan="2">
                                                         <p class="mb-0 fs-14">Notes :</p>
                                                        <span >{{ $dtheader->cnotes }}</span>
                                                    </td>
                                                    <td colspan="4"></td>
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
