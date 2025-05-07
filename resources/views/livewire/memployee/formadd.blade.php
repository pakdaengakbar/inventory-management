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
                        <a href="/master/employees" type="button" class="btn btn-warning btn-sm">
                            <i class="mdi mdi-redo-variant"></i> Back
                        </a>
                    </div>
                </div><!-- end card header -->
                <form wire:submit="store" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="ncompanie_id" class="form-label">Company <span class='text-danger'>*</span></label>
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
                            <div class="mb-2">
                                <label for="ndept_id" class="form-label">Department <span class='text-danger'>*</span></label>
                                <div class="col-lg-12 col-xl-12">
                                    <select class="form-select  @error('ndept_id') is-invalid @enderror" wire:model="ndept_id" >
                                        <option value="">Select Depart</option>
                                        @foreach ($depart as $c)
                                        <option value="{{ $c->id }}">{{ ucwords(strtolower($c->cname)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('ndept_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="nposition_id" class="form-label">Position <span class='text-danger'>*</span></label>
                                <div class="col-lg-12 col-xl-12">
                                    <select class="form-select  @error('nposition_id') is-invalid @enderror" wire:model="nposition_id" >
                                        <option value="">Select Position</option>
                                        @foreach ($position as $c)
                                        <option value="{{ $c->ccode }}">{{ ucwords(strtolower($c->cname)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('nposition_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="cemployee_num" class="form-label">Employee ID number <span class='text-danger'>*</span></label>
                                <input type="text" class="form-control @error('cemployee_num') is-invalid @enderror" placeholder="Employee Number" wire:model="cemployee_num">
                                @error('cemployee_num')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="caccount_num" class="form-label">Attendance Number <span class='text-danger'>*</span></label>
                                <input type="text" class="form-control @error('caccount_num') is-invalid @enderror" placeholder="Attendance Number" wire:model="caccount_num">
                                @error('caccount_num')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="cname" class="form-label">Employee Name <span class='text-danger'>*</span></label>
                                <input type="text" name="cname" class="form-control @error('cname') is-invalid @enderror"  placeholder="Employee Name" onkeyup="this.value=toUCword(this.value);" wire:model="cname">
                                @error('cname')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="creligion" class="form-label">Religion</label>
                                <select class="form-select" wire:model="creligion" >
                                    <option value="">Select Religion</option>
                                    <option value='Islam'>Islam</option>
                                    <option value='Protestan'>Protestan</option>
                                    <option value='Katolik'>Katolik</option>
                                    <option value='Hindu'>Hindu</option>
                                    <option value='Buddha'>Buddha</option>
                                    <option value='Konghucu'>Konghucu</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="ceducation" class="form-label">Education</label>
                                <select class="form-select" wire:model="ceducation" >
                                    <option value="">Select Education</option>
                                    <option value='Elementary School'>Elementary School</option>
                                    <option value='Junior High School'>Junior High School</option>
                                    <option value='Senior High School'>Senior High School</option>
                                    <option value='Vocational High School'>Vocational High School</option>
                                    <option value='Diploma'>Diploma</option>
                                    <option value='Bachelors Degree'>Bachelor's Degree</option>
                                    <option value='Masters Degree'>Master's Degree</option>
                                    <option value='Doctorate'>Doctorate</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="cmarital" class="form-label">Marital</label>
                                <select class="form-select" wire:model="cmarital" >
                                    <option value="">Select Education</option>
                                    <option value='Belum Kawin'>Belum Kawin</option>
                                    <option value='Kawin Belum Tercatat'>Kawin Belum Tercatat</option>
                                    <option value='Kawin Tercatat'>Kawin Tercatat</option>
                                    <option value='Cerai Hidup'>Cerai Hidup</option>
                                    <option value='Cerai Mati'>Cerai Mati</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label for="cdefault" class="form-label">Gender</label>
                                <select class="form-select" wire:model="csex" >
                                    <option value="">Select Gender</option>
                                    <option value='male'>Male</option>
                                    <option value='female'>Female</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="caddress1" class="form-label">Address 1 <span class='text-danger'>*</span></label>
                                <textarea class="form-control @error('caddress1') is-invalid @enderror" wire:model="caddress1" onkeyup="this.value=toUCword(this.value);" spellcheck="false" ></textarea>
                                @error('caddress1')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="caddress2" class="form-label">Address 2</label>
                                <textarea class="form-control" wire:model="caddress2" onkeyup="this.value=toUCword(this.value);" spellcheck="false" ></textarea>
                            </div>
                            <div class="mb-2">
                                <label for="ccity" class="form-label">City / Regency</label>
                                <div class="col-lg-12 col-xl-12">
                                    <input class="form-control" list="rowdata" id="ccity"  wire:model="ccity" placeholder="Type to search...">
                                    <datalist id="rowdata">
                                        @foreach ($cities as $c)
                                            <option value="{{ ucfirst(strtolower($c->name)) }}">{{ ucwords(strtolower($c->name)) }}</option>
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="cphone" class="form-label">Phone</label>
                                <div class="col-lg-12 col-xl-12">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="mdi mdi-phone-outline"></i></span>
                                        <input class="form-control" type="text"  name='cphone' placeholder="Phone"  wire:model="cphone"  aria-describedby="basic-addon1" value="6282192336868">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="cmobile" class="form-label">Mobile</label>
                                <div class="col-lg-12 col-xl-12">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="mdi mdi-phone-outline"></i></span>
                                        <input class="form-control" type="text"  name='cmobile' placeholder="Fax Number"  wire:model="cmobile"  aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="cemail" class="form-label">Email Address</label>
                                <div class="col-lg-12 col-xl-12">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="mdi mdi-email"></i></span>
                                        <input type="email" class="form-control" wire:model="cemail"  placeholder="Email" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="cpost_code" class="form-label">Post Code</label>
                                <input type="text" class="form-control" placeholder="Post Code" wire:model="cpost_code">
                            </div>

                            <div class="mb-2">
                                <label for="cdefault" class="form-label">Default</label>
                                <select class="form-select" wire:model="cstatus" >
                                    <option value="">Select Default</option>
                                    <option value='Actived'>Actived</option>
                                    <option value='Not Actived'>Not Actived</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4"></div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <div class="silva-main-sections">
                                    <div class="silva-profile-main">
                                        @if ($photo)
                                        <img src="{{ asset($url.$photo) }}" alt="logo" class="rounded-circle img-fluid avatar-xl img-thumbnail float-start" width='10%' id='file_image'>
                                        @else
                                        <img src="{{ asset('storage/NoImage.jpg') }}" alt="logo" class="rounded-circle img-fluid avatar-xl img-thumbnail float-start" width='10%' id='file_image'>
                                        @endif
                                    </div>
                                    <div class="overflow-hidden ms-md-4 ms-0">
                                        <p class="my-1 text-muted fs-16">iPhoto</p>
                                        <span class="fs-15"><i class="mdi mdi-message me-2 align-middle"></i>{{ $cname }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <div class="mb-2">
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
                                <div class="mb-2" hidden>
                                    <label class="form-label">Old-image</label>
                                    <input type="text" class="form-control" wire:model="photo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer float-end">
                    <button type="submit"  class="btn btn-primary btn-sm waves-effect waves-light"><i class="mdi mdi-content-save"></i> Save</button>
                    <a href="/master/employees" type="button" class="btn btn-warning btn-sm">
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
