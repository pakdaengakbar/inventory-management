@section('title')
    {{ $pageTitle }}
@endsection
@section('page-title')
    {{ $pageDescription }}
@endsection

<div>
<!-- Start Content-->
<div class="container-fluid">
<!-- Button Datatable -->
<div class="row mt-2">
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
                    <div class="col-12" hidden>
                         {!! MyHelper::setSearchRegion('region') !!}
                    </div>
                    <div class="col-12">
                        {!! MyHelper::setStatusCafe() !!}
                    </div>
                    <div class="col-12">
                        <div class="float-end mt-4">
                            <a href="{{ route('cashiers.add') }}" id='btn_add'type="button" class="btn btn-primary btn-sm">
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
                                    <th>Date</th>
                                    <th>Sales Num.</th>
                                    <th>Customer</th>
                                    <th class="col-1">Sub Total</th>
                                    <th class="col-1">Ppn</th>
                                    <th class="col-1">Disc</th>
                                    <th class="col-1">Total</th>
                                    <th class="col-1">Payment</th>
                                    <th class="col-1">Remaining</th>
                                    <th class="col-1">Status</th>
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

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    hiddenSidebar();
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
    var sdate  = $("#sdate").val(), edate = $("#edate").val();
    var region = $("#region").val(), status = $("#cstatus").val();
    if ($.fn.DataTable.isDataTable('#rowDatatable')) {
        $('#rowDatatable').DataTable().destroy();
    }
    $('#rowDatatable').DataTable({
        processing : true,
        paginationType : 'full_numbers',
        StateSave : true,
        ajax: {
            "url"  : '/cafe/rwdata/cashiers',
            "type" : "POST",
            "data" : {
                "sdate"  : sdate,
                "edate"  : edate,
                "region" : region,
                "status" : status,
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
            { data: 'no_faktur' },
            { data: 'cust_name' },
            { data: 'sub_total' },
            { data: 'tot_ppn' },
            { data: 'tot_disc' },
            { data: 'total' },
            { data: 'payment' },
            { data: 'remaining' },
            { data: 'status' },
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
