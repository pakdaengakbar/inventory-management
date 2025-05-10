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
    <!-- Button Datatable -->
    <div wire:ignore id="mAlert" class="alert alert-primary alert-dismissible fade d-none" role="alert">
        <span id="mAlertMessage"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="clearfix">
                        <div class="float-start d-flex justify-content-center">
                            <h5 class="mb-0 caption fw-semibold fs-18">{{ $pageDescription }}</h5>
                        </div>
                        <div class="float-end">
                            <button wire:click.stop="createBrand()" data-bs-toggle="modal" data-bs-target="#departModal" class="btn btn-sm btn-primary mb-3">
                                <i class="mdi mdi-plus"></i> Add Data</button>
                        </div>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <ul class="nav nav-underline border-bottom pt-2" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active p-2" data-bs-toggle="tab" id="brand_tab" href="#form_brand" role="tab" onclick="document.getElementById('flag').value = 1;">
                                <span class="d-block d-sm-none"><i class="mdi mdi-information"></i></span>
                                <span class="d-none d-sm-block">Brand</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link p-2" data-bs-toggle="tab" id="model_tab" href="#form_model" role="tab" onclick="document.getElementById('flag').value = 2; handleGroupData();">
                                <span class="d-block d-sm-none"><i class="mdi mdi-information"></i></span>
                                <span class="d-none d-sm-block">Model</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content text-muted bg-white">
                        <div class="tab-pane active show pt-4" id="form_brand" role="tabpanel">
                          <div wire:ignore>
                            <table id="brandDatatable" class="table">
                                <thead>
                                    <tr>
                                        <th class="col-1">No</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th class="col-1">Action</th>
                                    </tr>
                                </thead>
                            </table>
                          </div>
                        </div>
                        <div class="tab-pane show pt-4" id="form_model" role="tabpanel">
                            <div wire:ignore>
                            <table id="groupDatatable" class="table">
                                <thead>
                                    <tr>
                                        <th class="col-1">No</th>
                                        <th>Code</th>
                                        <th>Name</th>
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
    </div>

    <!--  Large modal example -->
    <div class="modal fade" wire:ignore.self id="departModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalDepart">Form Depart.</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Status Flag</label>
                        <input type="text" class="form-control" wire:model="flag" id='flag' readonly>
                    </div>
                    <div class="mb-3" hidden>
                        <label>ID</label>
                        <input type="text" class="form-control" wire:model="id" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Code</label>
                        <input type="text" class="form-control" wire:model="ccode" maxlength="5">
                        @error('ccode')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Nname</label>
                        <input type="text" class="form-control" wire:model="cname">
                        @error('cname')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="storeBrand()" data-bs-dismiss="modal" class="btn btn-primary ">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- container-fluid -->
</div>

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $('#brandDatatable').DataTable({
        processing : true,
        paginationType : 'full_numbers',
        StateSave : true,
        ajax: {
            "url"	 : '/product/rwdata/brands',
            "type"   : "POST",
        },
        columns: [
            { data: 'no' },
            { data: 'code' },
            { data: 'name' },
            { data: 'action' }
        ],
        responsive: true
    });
});

function handleGroupData() {
    console.warn('Group loaded');
    if ($.fn.DataTable.isDataTable('#groupDatatable')) {
        $('#groupDatatable').DataTable().destroy();
    }
    $('#groupDatatable').DataTable({
        processing : true,
        paginationType : 'full_numbers',
        StateSave : true,
        ajax: {
            "url"	 : '/product/rwdata/groups',
            "type"   : "POST",
        },
        columns: [
            { data: 'no' },
            { data: 'code' },
            { data: 'name' },
            { data: 'action' }
        ],
        responsive: true
    });
}

function handleTypeData() {
    console.warn('Type loaded');
    if ($.fn.DataTable.isDataTable('#typeDatatable')) {
        $('#typeDatatable').DataTable().destroy();
    }
    $('#typeDatatable').DataTable({
        processing : true,
        paginationType : 'full_numbers',
        StateSave : true,
        ajax: {
            "url"	 : '/product/rwdata/types',
            "type"   : "POST",
        },
        columns: [
            { data: 'no' },
            { data: 'code' },
            { data: 'name' },
            { data: 'action' }
        ],
        responsive: true
    });
}

Livewire.on('editDataBrand', (data) => {
    $('#brandDatatable').DataTable().ajax.reload(false, false);
});
Livewire.on('delDataBrand', (data) => {
    $('#brandDatatable').DataTable().ajax.reload(false, false);
});
</script>
@endsection
