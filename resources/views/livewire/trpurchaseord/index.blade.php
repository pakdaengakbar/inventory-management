@section('title')
    {{ $pageTitle }}d
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
        {!! MyHelper::setAlert() !!}
        <div class="card">
            <div class="card-header">
                <div class="clearfix">
                    <div class="float-start d-flex justify-content-center">
                        <h5 class="mb-0 caption fw-semibold fs-18">{{ $pageDescription }}</h5>
                    </div>
                </div>
            </div><!-- end card header -->
            <div class="card-body">
                <form class="row row-cols-lg-auto g-3 align-items-center mb-3">
                    {!! MyHelper::getSearchByDate() !!}
                    <div class="col-12">
                         {!! MyHelper::setSearchRegion('region') !!}
                    </div>
                    <div class="col-12">
                        <div class="float-end mt-4">
                            <a href="{{ route('puorder.add') }}" id='btn_add'type="button" class="btn btn-primary btn-sm">
                                <i class="mdi mdi-plus"></i> New Data
                            </a>
                            <a href="javascript:;" type="button" class="btn btn-warning btn-sm" id="btn_reload" onclick="handleData();">
                                <i class="mdi mdi-reload"></i> Reload
                            </a>
                        </div>
                    </div>
                </form>
                <div class="mb-1">
                    <div wire:ignore>
                        <table id="rowDatatable" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Trans. Date</th>
                                    <th>No Puchase</th>
                                    <th>No Order</th>
                                    <th>Supplier</th>
                                    <th>Supplier Inv.</th>
                                    <th>Notes</th>
                                    <th class="col-1">Total</th>
                                    <th class="col-1">Status</th>
                                    <th>Region</th>
                                    <th class="col-1">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
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

    if (window.Livewire) {
        console.warn('Livewire actived.');
        Livewire.hook('message.processed', (message, component) => {
            handleAlert();
        });
    } else {
        console.warn('Livewire is not loaded.');
    }
    handleData();
});

function handleData() {
    var sdate = $("#sdate").val(), edate = $("#edate").val();
    var region = $("#region").val();
    if ($.fn.DataTable.isDataTable('#rowDatatable')) {
        $('#rowDatatable').DataTable().destroy();
    }
    $('#rowDatatable').DataTable({
        processing : true,
        paginationType : 'full_numbers',
        StateSave : true,
        ajax: {
            "url"  : '/inventory/rwdata/puorder',
            "type" : "POST",
            "data" : {
                "sdate" : sdate,
                "edate" : edate,
                "region" : region
            },
            "dataSrc": function (json) {
                if (!json || typeof json !== 'object') {
                    console.error('Invalid JSON response:', json);
                    return [];
                }
                return json.data || [];
            }
        },
        columns: [
            { data: 'no' },
            { data: 'trnsdate' },
            { data: 'no_po' },
            { data: 'no_order' },
            { data: 'supplier' },
            { data: 'suppinv' },
            { data: 'notes' },
            { data: 'total' },
            { data: 'status' },
            { data: 'region' },
            { data: 'action' }
        ],
        responsive: true
    });

}

Livewire.on('delDataTable', (data) => {
    $('#rowDatatable').DataTable().ajax.reload(false, true);
    viewAlert(data[0].message);
});
</script>
@endsection
