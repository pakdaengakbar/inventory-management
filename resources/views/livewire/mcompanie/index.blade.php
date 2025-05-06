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
        @if($message)
            <div class="alert alert-primary alert-dismissible fade show" id="mAlert" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <div class="clearfix">
                    <div class="float-start d-flex justify-content-center">
                        <h5 class="mb-0 caption fw-semibold fs-18">{{ $pageDescription }}</h5>
                    </div>
                    <div class="float-end">
                        <a href="{{ route('companies.add') }}" id='btn_add'type="button" class="btn btn-primary btn-sm">
                            <i class="mdi mdi-plus"></i> New Data
                        </a>
                        <a href="javascript:;" type="button" class="btn btn-warning btn-sm" onclick="window.location.reload();">
                            <i class="mdi mdi-reload"></i> Reload
                        </a>

                    </div>
                </div>
            </div><!-- end card header -->
            <div class="card-body">
                <table id="responsive-datatable" class="table table-bordered table-bordered">
                    <thead>
                        <tr>
                            <th width="7%" class='text-center'>Logo</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th width="20%">Email</th>
                            <th width="13%">Phone</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $row)
                        <tr>
                            <td class="text-center">
                                <img src="{{ asset($path.$row->clogo) }}" alt="logo" class="rounded-circle img-fluid avatar-sm img-thumbnail" width='20%' id='file_image'>
                            </td>
                            <td>{{ $row->cname }}</td>
                            <td>{!! $row->caddress1 !!}</td>
                            <td>{{ $row->cemail }}</td>
                            <td>{{ $row->cphone1 }}</td>
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
