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
<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-semibold m-0">{{ $pageTitle }} </h4>
    </div>
    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
            <li class="breadcrumb-item active">{{ $pageDescription }} </li>
        </ol>
    </div>
</div>

<!-- Button Datatable -->
<div class="row">
    <div class="col-12">
         @if (session()->has('message'))
            <div class="alert alert-primary alert-dismissible fade show" id="mAlert" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
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
                            <table id="dtdepart" class="table table-bordered table-bordered">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Address</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($departs as $row)
                                    <tr>
                                        <td>{{ $row->ccode }}</td>
                                        <td>{!! $row->cname !!}</td>
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
<!-- container-fluid -->
</div>
</div>

<div id="forms"><div id="form"></div></div>
</div>

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    $('#dtdepart').DataTable();
    $('#dtposition').DataTable();

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
});
</script>
@endsection
