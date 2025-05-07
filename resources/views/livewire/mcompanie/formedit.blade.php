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
                        <a href="/companies" type="button" class="btn btn-warning btn-sm">
                            <i class="mdi mdi-redo-variant"></i> Back
                        </a>
                    </div>
                </div><!-- end card header -->
                <form wire:submit="update" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3" hidden>
                                <label class="form-label">ID</label>
                                <input class="form-control" type="text"  wire:model="ID" placeholder="AutoSystem" readonly>
                            </div>
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
                                <label for="caddress" class="form-label">Address-1</label>
                                <textarea class="form-control @error('caddress1') is-invalid @enderror" wire:model="caddress1" rows="3" spellcheck="false" ></textarea>
                                @error('caddress1')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="caddress2" class="form-label">Address-2</label>
                                <textarea class="form-control" wire:model="caddress2" rows="3" spellcheck="false" ></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="ccity" class="form-label">City</label>
                                <div class="col-lg-12 col-xl-12">
                                    <input class="form-control" list="rowdata" id="ccity"  wire:model="ccity" placeholder="Type to search...">
                                    <datalist id="rowdata">
                                        @foreach ($cities as $c)
                                            <option value="{{ ucfirst(strtolower($c->name)) }}">{{ ucwords(strtolower($c->name)) }}</option>
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="ccontact" class="form-label">Contact</label>
                                <input type="text" class="form-control" placeholder="Contact Name" wire:model="ccontact" >
                            </div>
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
                                <label for="cphone1" class="form-label">Phone-1</label>
                                <input type="text" class="form-control" placeholder="Phone-1" wire:model="cphone1">
                            </div>
                            <div class="mb-3">
                                <label for="cphone2" class="form-label">Phone-2</label>
                                <input type="text" class="form-control" placeholder="Phone-2" wire:model="cphone2">
                            </div>
                            <div class="mb-3">
                                <label for="cfax1" class="form-label">Fax-1</label>
                                <input type="text" class="form-control" placeholder="Fax-1" wire:model="cfax1">
                            </div>


                        </div>
                        <div class="col-lg-6">
                           <div class="mb-3">
                                <label for="cdefault" class="form-label">Default</label>
                                <select class="form-select" wire:model="cdefault" >
                                    <option value="">Select Default</option>
                                    <option value='1'>Yes</option>
                                    <option value='0'>No</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <div class="silva-main-sections">
                                    <div class="silva-profile-main">
                                        <img src="{{ asset($url.$photo) }}" alt="logo" class="rounded-circle img-fluid avatar-xl img-thumbnail float-start" width='10%' id='file_image'>
                                    </div>
                                    <div class="overflow-hidden ms-md-4 ms-0">
                                        <p class="my-1 text-muted fs-16">Logo Company</p>
                                        <span class="fs-15"><i class="mdi mdi-message me-2 align-middle"></i>{{ $cname }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <div class="mb-3">
                                    <label for="ccontact" class="form-label">File Logo</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="file-upload" wire:model="image">
                                    <!-- error message untuk title -->
                                    @if ($image)
                                        <div class="mt-3">
                                            <div class="silva-main-sections">
                                                <div class="silva-profile-main">
                                                    <img src="{{ $image->temporaryUrl() }}" alt="Image Preview" class="rounded-circle img-fluid avatar-xl img-thumbnail float-start">
                                                </div>
                                                <div class="overflow-hidden ms-md-4 ms-0">
                                                    <p class="my-1 text-muted fs-16">Preview Image</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3" hidden>
                                    <label class="form-label">Old-image</label>
                                    <input type="text" class="form-control" wire:model="photo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer float-end">
                    <button type="submit"  class="btn btn-primary btn-sm waves-effect waves-light"><i class="mdi mdi-content-save"></i> Save</button>
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

@section('script')
<script>
    // document.getElementById("file-upload").addEventListener("change", function(event) {
    //     var input = event.target;
    //     if (input.files && input.files[0]) {
    //         var reader = new FileReader();
    //         reader.onload = function(e) {
    //             document.getElementById("file_image").src = e.target.result;
    //         }
    //         reader.readAsDataURL(input.files[0]);
    //     }
    // });
</script>
@endsection
