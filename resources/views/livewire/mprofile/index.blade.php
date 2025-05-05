@section('title')
    {{ $pageTitle }}
@endsection
@section('page-title')
    {{ $pageDescription }}
@endsection
<div>
<!-- Start Content-->
<div class="container-fluid">
    <!-- flash message -->
    {!! $pageBreadcrumb !!}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <img src="/images/small/user-image.jpg" class="rounded-top-2 img-fluid" alt="image data">
                <div class="card-body">
                    <div class="align-items-center">
                        <div class="silva-main-sections">
                            <div class="silva-profile-main">
                                <img src="{{ asset($url.$photo) }}" class="rounded-circle img-fluid avatar-xxl img-thumbnail float-start" alt="image">
                                <span class="sil-profile_main-pic-change img-thumbnail">
                                    <i class="mdi mdi-camera text-white"></i>
                                </span>
                            </div>
                            <div class="overflow-hidden ms-md-4 ms-0">
                                <h4 class="m-0 text-dark fs-20 mt-2 mt-md-0">{{ $user_name }}</h4>
                                <p class="my-1 text-muted fs-16">{{ $ctitle }}</p>
                                <span class="fs-15"><i class="mdi mdi-message me-2 align-middle"></i>{{ $cemail }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('message'))
        <div class="alert alert-primary alert-dismissible fade show" id="mAlert" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body pt-0">
                    <ul class="nav nav-underline border-bottom pt-2" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active p-2" id="profile_about_tab" data-bs-toggle="tab" href="#profile_about" role="tab">
                                <span class="d-block d-sm-none"><i class="mdi mdi-information"></i></span>
                                <span class="d-none d-sm-block">Informasi</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link p-2" id="setting_tab" data-bs-toggle="tab" href="#profile_setting" role="tab">
                                <span class="d-block d-sm-none"><i class="mdi mdi-information"></i></span>
                                <span class="d-none d-sm-block">Setting</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content text-muted bg-white">
                        <div class="tab-pane active show pt-4" id="profile_about" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-md-6 mb-4">
                                    <div class="">
                                        <h5 class="fs-16 text-dark fw-semibold mb-3 text-capitalize">Aplication Name</h5>
                                        <p>{{ $cname }}</p>
                                        <h5 class="fs-16 text-dark fw-semibold mb-3 text-capitalize">Title</h5>
                                        <p>{{ $ctitle }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-md-6 mb-4">
                                    <h5 class="fs-16 text-dark fw-semibold mb-3 text-capitalize">Contact Details</h5>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-lg-4 mb-3">
                                            <div class="profile-email mb-md-2">
                                                <h6 class="text-uppercase fs-13">Email Addess</h6>
                                                <a href="#" class="text-primary fs-14 text-decoration-underline">{{ $cemail }}</a>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-lg-4 mb-3">
                                            <div class="profile-email">
                                                <h6 class="text-uppercase fs-13">Location</h6>
                                                <a href="#" class="fs-14">{{ $caddress }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end Experience -->
                        <div class="tab-pane pt-4" id="profile_setting" role="tabpanel">
                            <div class="row">
                                <form wire:submit="update" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6 col-xl-6">
                                        <div class="card border">
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="ccode" class="form-label">ID</label>
                                                    <input type="text" class="form-control" placeholder="Id Branch" wire:model="id" readonly>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">Application Name</label>
                                                    <div class="col-lg-12 col-xl-12">
                                                        <input class="form-control @error('cname') is-invalid @enderror" type="text" name='cname' wire:model="cname" placeholder="Application Name">
                                                        @error('cname')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label" for="cmotto">Motto</label>
                                                    <div class="col-lg-12 col-xl-12">
                                                        <input class="form-control" type="text"  name='cmotto' wire:model="cmotto" placeholder="Motto">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label" for="ctitle">Title</label>
                                                    <div class="col-lg-12 col-xl-12">
                                                        <input class="form-control" type="text"  name='ctitle' wire:model="ctitle" placeholder="Title">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label" for="cmotto">Address</label>
                                                    <div class="col-lg-12 col-xl-12">
                                                        <textarea name="caddress" rows="3" wire:model="caddress" class="form-control @error('caddress') is-invalid @enderror"></textarea>
                                                        @error('caddress')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label for="ccity" class="form-label">City</label>
                                                    <div class="col-lg-12 col-xl-12">
                                                        <input class="form-control" list="rowdata" id="ccity"  wire:model="ccity" placeholder="Type to search...">
                                                        <datalist id="rowdata">
                                                            @foreach ($cities as $c)
                                                                <option value="{{ $c->name }}">{{ ucfirst($c->name) }}</option>
                                                            @endforeach
                                                        </datalist>
                                                    </div>
                                                 </div>
                                            </div><!--end card-body-->
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-6">
                                        <div class="card border mb-0">
                                            <div class="card-body mb-0">
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">Contact Phone</label>
                                                    <div class="col-lg-12 col-xl-12">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="mdi mdi-phone-outline"></i></span>
                                                            <input class="form-control" type="text"  name='cphone' placeholder="Phone"  wire:model="cphone"  aria-describedby="basic-addon1" value="6282192336868">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">Fax Number</label>
                                                    <div class="col-lg-12 col-xl-12">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="mdi mdi-phone-outline"></i></span>
                                                            <input class="form-control" type="text"  name='cfax' placeholder="Fax Number"  wire:model="cfax"  aria-describedby="basic-addon1" value="{{ $cfax }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">Email Address</label>
                                                    <div class="col-lg-12 col-xl-12">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="mdi mdi-email"></i></span>
                                                            <input type="text" class="form-control" wire:model="cemail"  placeholder="Email" aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">Upload Logo</label>
                                                    <div class="col-lg-12 col-xl-12">
                                                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="file-upload" wire:model.defer="image">
                                                        <div wire:loading wire:target="image" class="text-muted mt-2">Uploading...</div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label for="cstatus" class="form-label">Status</label>
                                                    <div class="col-lg-12 col-xl-12">
                                                        <select class="form-select" wire:model="cstatus" >
                                                            <option value="">Select Status</option>
                                                            <option value='0'>Not Active</option>
                                                            <option value='1'>Actived</option>
                                                        </select>
                                                        </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-12 col-xl-12">
                                                        <button type="submit" class="btn btn-primary mb-2 mb-md-0">Update</button>
                                                    </div>
                                                </div>
                                            </div><!--end card-body-->
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div> <!-- end education -->
                    </div> <!-- Tab panes -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- container-fluid -->
</div>

@section('scripts')
<script type="text/javascript">
$(function () {
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(function() {
            document.getElementById('mAlert').classList.add('hide');
        }, 2000); // 5000 ms = 5 seconds
    });
});

function toUCword(str){
	return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
		return $1.toUpperCase();
	});
}
</script>
@endsection
