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
                                <span class="d-none d-sm-block">Position</span>
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
                                <table class="table table-bordered table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Code</th>
                                            <th>Address</th>
                                            <th class='col-1'>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($departs as $row)
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td>{{ $row->ccode }}</td>
                                            <td>{!! $row->cname !!}</td>
                                            <td class="text-center">
                                                <button wire:click="editDept({{ $row->id }})" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#departModal" title='Update'><i class="mdi mdi-square-edit-outline"></i></button>
                                                <button wire:click="delDept({{ $row->id }})" class="btn btn-sm btn-danger" title='Delete'><i class="mdi mdi-trash-can-outline"></i></button>
                                            </td>
                                        </tr>
                                        @empty
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                Empty Row Data
                                            </div>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $departs->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                        <div class="tab-pane pt-4" id="form_position" role="tabpanel">
                        <div class="row">
                                <table id="dtposition" class="table table-bordered table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Address</th>
                                            <th>Location</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($positions as $row)
                                        <tr>
                                            <td>{{ $row->ccode }}</td>
                                            <td>{!! $row->cname !!}</td>
                                            <td>{{ $row->clocation }}</td>
                                            <td class="text-center">
                                                <a href="/companies/edit/{{ $row->id }}" class="btn btn-sm btn-warning" title='Update'><i class="mdi mdi-square-edit-outline"></i></a>
                                                <button wire:click="destroy({{ $row->id }})" class="btn btn-sm btn-danger" title='Delete'><i class="mdi mdi-trash-can-outline"></i></button>
                                            </td>
                                        </tr>
                                        @empty
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                Empty Row Data
                                            </div>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end education -->
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
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ncompanie_id" class="form-label">Company</label>
                        <select class="form-select @error('ncompanie_id') is-invalid @enderror" wire:model="ncompanie_id">
                            <option value="">Select Company</option>
                            @foreach ($company as $c)
                                <option value="{{ $c->id }}">{{ ucfirst($c->id.' - '.$c->cname) }}</option>
                            @endforeach
                        </select>
                        @error('ncompanie_id')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" class="form-control  @error('deptcode') is-invalid @enderror" wire:model="deptcode" maxlength="3">
                        @error('deptcode')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Name</label>
                        <textarea class="form-control @error('deptname') is-invalid @enderror" wire:model="deptname"></textarea>
                        @error('deptname')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" id='closeModal'>Close</button>
                    <button type="button" wire:click.prevent="store()" class="btn btn-primary ">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- container-fluid -->

</div>

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    $('#dtposition').DataTable();
});

Livewire.on('showAlert', (data) => {
    initDataTable()
    $("#closeModal").click();

    const alertElement = document.getElementById('mAlert');
    const messageElement = document.getElementById('mAlertMessage');

    if (alertElement && messageElement) {
        const message = data[0].message;  // <- get the string

        messageElement.textContent = message;
        alertElement.classList.remove('d-none');
        alertElement.classList.add('show');

        setTimeout(() => {
            bootstrap.Alert.getOrCreateInstance(alertElement).close();
        }, 2000);
    }
});

function handleAlert() {
    const alertElement = document.getElementById('mAlert');
    console.log(alertElement);

    if (alertElement) {
        console.log('Auto-closing alert');
        setTimeout(function () {
            const alertInstance = bootstrap.Alert.getOrCreateInstance(alertElement);
            alertInstance.close();
        }, 3000);
    }
}

function initDataTable() {
    console.log('updateDataTable');

    if ($.fn.DataTable.isDataTable('#dtposition')) {
        $('#dtposition').DataTable().clear().destroy();
    }

    $('#dtposition').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        responsive: true
    });
}

</script>
@endsection
