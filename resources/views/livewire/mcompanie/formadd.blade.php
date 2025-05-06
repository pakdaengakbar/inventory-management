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
                        <h5 class="card-title mb-0 caption fw-semibold fs-18">Input Type</h5>
                    </div>
                    <div class="float-end">
                        <a href="/companies" type="button" class="btn btn-warning btn-sm">
                            <i class="mdi mdi-redo-variant"></i> Back
                        </a>
                    </div>
                </div><!-- end card header -->
                <form wire:submit="store" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="cname" class="form-label">Company Name</label>
                                <input type="text" name="cname" class="form-control @error('cname') is-invalid @enderror"  wire:model="cname">
                                @error('cname')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="cdescription" class="form-label">Description</label>
                                <textarea class="form-control" spellcheck="false" wire:model="cdescription"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="caddress" class="form-label">Address</label>
                                <textarea class="form-control @error('caddress') is-invalid @enderror" wire:model="caddress" rows="3" spellcheck="false" ></textarea>
                                @error('caddress')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="clocation" class="form-label">Location</label>
                                <input type="text" class="form-control" placeholder="Location" wire:model="clocation" >
                            </div>
                            <div class="mb-3">
                                <label for="cowner" class="form-label">Owner</label>
                                <input type="text" class="form-control" placeholder="Owner Name" wire:model="cowner" >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="cemail" class="form-label">Email</label>
                                <input type="email" class="form-control @error('cemail') is-invalid @enderror" placeholder="Email" wire:model="cemail">
                                @error('cemail')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="chotline" class="form-label">Hotline</label>
                                <input type="text" class="form-control @error('chotline') is-invalid @enderror" placeholder="Hotline" wire:model="chotline">
                                @error('chotline')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="cwebsite" class="form-label">Website</label>
                                <input type="text" class="form-control" placeholder="Website" wire:model="cwebsite" >
                            </div>
                            <div class="form-group mb-4">
                                <label class="fw-bold">Logo</label>
                                <!-- error message untuk title -->
                                <input type="file" class="form-control" wire:model="image">
                                <!-- error message untuk title -->
                                @if ($image)
                                    <div class="mt-3">
                                        <p>Preview:</p>
                                        <img src="{{ $image->temporaryUrl() }}" alt="Image Preview" class="img-thumbnail" style="max-width: 120px;">
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="cstatus" class="form-label">Status</label>
                                <select class="form-select" wire:model="cstatus" >
                                    <option value="">Select Status</option>
                                    <option value='1'>Active</option>
                                    <option value='0'>No Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer float-end">
                    <button type="submit" id="btn_save" data-bs-dismiss="modal" class="btn btn-primary btn-sm waves-effect waves-light"><i class="mdi mdi-content-save"></i> Save</button>
                    <a href="/companies" type="button" class="btn btn-warning btn-sm">
                        <i class="mdi mdi-redo-variant"></i> Back
                    </a>
                </div>
                </form>
            </div>
        </div>
    </div>
</div> <!-- container-fluid -->
</div>
