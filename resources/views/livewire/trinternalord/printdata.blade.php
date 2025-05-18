@section('title')
    {{ $pageTitle }}
@endsection
@section('page-title')
    {{ $pageDescription }}
@endsection
<div>
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">{{ $pageDescription }}</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $pageTitle }}</a></li>
                    <li class="breadcrumb-item active">{{ $pageDescription }}</li>
                </ol>
            </div>
        </div>

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
                                    <h4 class="fs-18">#{{ $dtheader->cno_inorder }}<br>
                                        <strong class="fs-15 fw-normal">Internal Order</strong>
                                    </h4>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="float-start mt-3">
                                        <address>
                                            <strong>Internal Order :</strong><br>
                                            {{ $profile->cname }}<br>
                                            {{ $profile->caddress }}<br>
                                            <abbr title="Phone">P:</abbr> {{ $profile->cphone }}
                                        </address>
                                    </div>
                                    <div class="float-end mt-3">
                                        <address>
                                            <strong>Branch Region : </strong><br>
                                            <table>
                                                <tbody>
                                                <tr>
                                                    <td class="pe-3">Region</td>
                                                    <td class="pe-1">:</td>
                                                    <td>{{ $dtheader->region->cname }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pe-3">Address</td>
                                                    <td class="pe-1">:</td>
                                                    <td>{{ $dtheader->region->caddress1 }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pe-3">Phone</td>
                                                    <td class="pe-1">:</td>
                                                    <td>{{ $dtheader->region->cphone }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </address>
                                    </div>
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
