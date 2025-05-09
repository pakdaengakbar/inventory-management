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
                <div class="card-body">
                    <ul class="nav nav-underline border-bottom pt-2" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active p-2" id="profile_about_tab" data-bs-toggle="tab" href="#form_depart" role="tab">
                                <span class="d-block d-sm-none"><i class="mdi mdi-information"></i></span>
                                <span class="d-none d-sm-block">Departement</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link p-2" id="setting_tab" data-bs-toggle="tab" href="#form_position" role="tab">
                                <span class="d-block d-sm-none"><i class="mdi mdi-information"></i></span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content text-muted bg-white">
                        <div class="tab-pane active show pt-4" id="form_depart" role="tabpanel">
                            <div class="row">
                                <div class="clearfix">
                                    <div class="float-start d-flex justify-content-center">
                                        <h5 class="mb-0 caption fw-semibold fs-18">{{ $pageDescription }}</h5>
                                    </div>
                                    <div class="float-end">
                                        <button  wire:click.stop="createDepart()" data-bs-toggle="modal" data-bs-target="#departModal" class="btn btn-primary mb-3">Add Data</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div wire:ignore>
                                    <table id="rowDatatable" class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Note</th>
                                                <th>Action</th>
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
                    <div class="mb-3">
                        <label>Notes</label>
                        <textarea class="form-control" wire:model="cnote"></textarea>
                        @error('cnote')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="store()" data-bs-dismiss="modal" class="btn btn-primary ">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- container-fluid -->
</div>

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    $('#rowDatatable').DataTable({
        processing : true,
        paginationType : 'full_numbers',
        StateSave : true,
        ajax: '/master/rwdata/expeditons',
        columns: [
            { data: 'no' },
            { data: 'code' },
            { data: 'name' },
            { data: 'note' },
            { data: 'action' }
        ],
        responsive: true
    });
});
Livewire.on('editDataTable', (data) => {
    $('#rowDatatable').DataTable().ajax.reload(false, false);
});

Livewire.on('delDataTable', (data) => {
    $('#rowDatatable').DataTable().ajax.reload(false, false);
});
</script>
@endsection
