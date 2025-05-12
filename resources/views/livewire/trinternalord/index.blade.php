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
        <div wire:ignore>
            <div class="alert alert-primary alert-dismissible fade show" id="mAlert" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
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
                <form class="row row-cols-lg-auto g-3 align-items-center mb-3">
                    <div class="col-12">
                        <span>Date :</span>
                    </div>
                    <div class="col-12">
                        <label for="sdate" class="visually-hidden">Start Date</label>
                        <input type="date" id="sdate" class="form-control" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-12">
                        <span>To :</span>
                    </div>
                    <div class="col-12">
                        <label for="edate" class="visually-hidden">End Date</label>
                        <input type="date" id="edate" class="form-control" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-12">
                        <div class="float-end">
                            <a href="{{ route('products.add') }}" id='btn_add'type="button" class="btn btn-primary btn-sm">
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
                                    <th>No Int.Order</th>
                                    <th>Supplier</th>
                                    <th>Notes</th>
                                    <th>Total</th>
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

<div id="forms"><div id="form"></div></div>
</div>

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    handleAlert();
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

function handleAlert() {
    const alertElement = document.getElementById('mAlert');
    if (alertElement) {
        setTimeout(function () {
            const alertInstance = bootstrap.Alert.getOrCreateInstance(alertElement);
            alertInstance.close();
        }, 2000);
    }
}

function handleData() {
    var sdate = $("#sdate").val(), edate = $("#edate").val();
    if ($.fn.DataTable.isDataTable('#rowDatatable')) {
        $('#rowDatatable').DataTable().destroy();
    }

    $('#rowDatatable').DataTable({
        processing : true,
        paginationType : 'full_numbers',
        StateSave : true,
        ajax: {
            "url"  : '/inventory/rwdata/intorder',
            "type" : "POST",
            "data" : {
                "sdate" : sdate,
                "edate" : edate
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
            { data: 'nofaktur' },
            { data: 'supplier' },
            { data: 'notes' },
            { data: 'total' },
            { data: 'status' },
            { data: 'action' }
        ],
        responsive: true
    });

}

Livewire.on('delDataTable', (data) => {
    $('#rowDatatable').DataTable().ajax.reload(null, true);
    setTimeout(function () {
        $("#mAlert").hide();
    }, 3000);
});
</script>
@endsection
