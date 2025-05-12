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
    <!-- General Form -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-start d-flex justify-content-center">
                        <h5 class="card-title mb-0 caption fw-semibold fs-18">{{ $pageDescription }}</h5>
                    </div>
                    <div class="float-end">
                        <a href="/master/suppliers" type="button" class="btn btn-warning btn-sm">
                            <i class="mdi mdi-redo-variant"></i> Back
                        </a>
                    </div>
                </div><!-- end card header -->
                <form wire:submit="store" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label for="cname" class="form-label">Code</label>
                                <input type="text" class="form-control" wire:model="ccode" placeholder="Automatic" readonly>
                            </div>
                            <div class="mb-2">
                                <label for="cname" class="form-label">Name</label>
                                <input type="text" class="form-control" wire:model="cname" onkeyup="this.value=toUCword(this.value);"  placeholder="Enter name">
                            </div>

                            <div class="mb-2">
                                <label for="cphone" class="form-label">Phone</label>
                                <input type="text" class="form-control" wire:model="cphone" placeholder="Enter phone number">
                            </div>
                             <div class="mb-2">
                                    <label for="cemail" class="form-label">Email</label>
                                    <input type="email" class="form-control" wire:model="cemail" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label for="caddress" class="form-label">Address</label>
                                <textarea class="form-control" rows="3" wire:model="caddress" onkeyup="this.value=toUCword(this.value);" placeholder="Enter address"></textarea>
                            </div>

                            {!! MyHelper::setStatusMaster() !!}
                        </div>
                    </div>
                    </div>
                    <div class="card-footer float-end">
                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">
                            <i class="mdi mdi-content-save"></i> Save
                        </button>
                        <a href="/master/suppliers" type="button" class="btn btn-warning btn-sm">
                            <i class="mdi mdi-redo-variant"></i> Back
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div> <!-- container-fluid -->
</div>

@section('script')
<script>
function toUCword(str){
	return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
		return $1.toUpperCase();
	});
}
</script>
@endsection
