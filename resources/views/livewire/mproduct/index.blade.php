@section('title')
    {{ $pageTitle }}
@endsection
@section('page-title')
    {{ $pageDescription }}
@endsection

<div>
<div id="views">
<!-- Start Content-->
<div class="container-fluid">
{!! $pageBreadcrumb !!}
<!-- Button Datatable -->
<div class="row">
    <div class="col-12">
        @if (session()->has('message'))
            <div class="alert alert-primary alert-dismissible fade show" id="mAlert" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <div class="clearfix">
                    <div class="float-start d-flex justify-content-center">
                        <h5 class="mb-0 caption fw-semibold fs-18">{{ $pageDescription }}</h5>
                    </div>

                </div>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <label for="ncompanie_id" class="col-sm-2 col-form-label">Company</label>
                            <div class="col-sm-5">
                                <select class="form-select" id="cgroup">
                                    <option value="">All Data</option>
                                    <option disabled>Select Group</option>
                                    @foreach ($group as $c)
                                        <option value="{{ $c->ccode }}">{{ $c->ccode.' - '.ucwords(strtolower($c->cname)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="float-end">
                            <a href="{{ route('customers.add') }}" id='btn_add'type="button" class="btn btn-primary btn-sm">
                                <i class="mdi mdi-plus"></i> New Data
                            </a>
                            <a href="javascript:;" type="button" class="btn btn-warning btn-sm" onclick="handleData();">
                                <i class="mdi mdi-reload"></i> Reload
                            </a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="mb-1">
                <table id="rowDatatable" class="table table-bordered table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Item Code</th>
                            <th>Item Name</th>
                            <th>Barcode</th>
                            <th class="col-1">UoM</th>
                            <th class="col-1">Price</th>
                            <th class="col-1">Sell</th>
                            <th class="col-1">Action</th>
                        </tr>
                    </thead>
                </table>
                 </div>
            </div>

        </div>
    </div>
</div>
<!-- container-fluid -->
</div>
</div>

<div id="forms"><div id="form"></div></div>
</div>

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    handleAlert();
    if (window.Livewire) {
        Livewire.hook('message.processed', (message, component) => {
            handleAlert();
        });
    } else {
        console.warn('⚠️ Livewire is not loaded.');
    }

    function handleAlert() {
        console.log('Close Alert');
        const alertElement = document.getElementById('mAlert');
        if (alertElement) {
            setTimeout(function () {
                const alertInstance = bootstrap.Alert.getOrCreateInstance(alertElement);
                alertInstance.close();
            }, 2000);
        }
    }

    handleData();
});

function handleData() {
    var group = $("#cgroup").val();
    console.warn('Ajax loaded : '+group);

    if ($.fn.DataTable.isDataTable('#rowDatatable')) {
        $('#rowDatatable').DataTable().destroy();
    }

    $('#rowDatatable').DataTable({
        processing : true,
        paginationType : 'full_numbers',
        StateSave : true,
        ajax: {
            "url"	 : '/master/rwdata/products',
            "type"   : "POST",
            "data" : {
                    "group"  : group,
            }
        },
        columns: [
            { data: 'no' },
            { data: 'item_code' },
            { data: 'item_name' },
            { data: 'barcode' },
            { data: 'uom_code' },
            { data: 'price' },
            { data: 'sell' },
            { data: 'action' }
        ],
        responsive: true
    });

}
</script>
@endsection
