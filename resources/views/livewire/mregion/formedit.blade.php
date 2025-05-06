@section('title')
    {{ $pageTitle }} 
@endsection
@section('page-title')
    {{ $pageDescription }}
@endsection

<div>
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
                        <a href="/branchs" type="button" class="btn btn-warning btn-sm">
                            <i class="mdi mdi-redo-variant"></i> Back
                        </a>
                    </div>
                </div>
                <form wire:submit="update" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3" hidden>
                                <label for="ccode" class="form-label">ID</label>
                                <input type="text" class="form-control" placeholder="Id Branch" wire:model="ID" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="ccode" class="form-label">Code</label>
                                <input type="text" class="form-control" placeholder="Location" wire:model="ccode" readonly>
                            </div>
                            <div class="mb-3"> 
                                <label for="clocation" class="form-label">Company</label>
                                <select class="form-select @error('ncompanyid') is-invalid @enderror" wire:model="ncompanyid">
                                    <option value="">Select Company</option>
                                    @foreach ($company as $c)
                                        <option value="{{ $c->id }}">{{ ucfirst($c->id.' - '.$c->cname) }}</option>
                                    @endforeach
                                </select>
                                @error('ncompanyid')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
							</div>
                            <div class="mb-3"> 
                                <label for="cname" class="form-label">Name</label>
                                <input type="text" name="cname" class="form-control @error('cname') is-invalid @enderror"  placeholder="Name of Branch"  onkeyup="this.value=toUCword(this.value);" wire:model="cname">
                                @error('cname')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="caddress" class="form-label">Address</label>
                                <textarea class="form-control" wire:model="caddress" rows="3" spellcheck="false" placeholder="Address" onkeyup="this.value=toUCword(this.value);"  ></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="cdescription" class="form-label">Description</label>
                                <textarea class="form-control" wire:model="cdescription" rows="3" spellcheck="false" placeholder="Description"  onkeyup="this.value=toUCword(this.value);"  ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="cphone" class="form-label">Phone</label>
                                <input type="text" class="form-control" placeholder="Phone" wire:model="cphone">
                            </div>
                            <div class="mb-3">
                                <label for="cemail" class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Email" wire:model="cemail">
                            </div>
                            <div class="mb-3">
                                <label for="clocation" class="form-label">Location</label>
                                <input type="text" class="form-control" placeholder="Branch Location" wire:model="clocation" onkeyup="this.value=toUCword(this.value);"  >
                            </div>
                            <div class="mb-3">
                                <label for="cbranch_manager" class="form-label">Branch Manager</label>
                                <input type="text" class="form-control" placeholder="Branch Manager" wire:model="cbranch_manager" onkeyup="this.value=toUCword(this.value);"  >
                            </div>
                            <div class="mb-3">
                                <label for="cbranch_supervisor" class="form-label">Branch Supervisor</label>
                                <input type="text" class="form-control" placeholder="Branch Superviso " wire:model="cbranch_supervisor" onkeyup="this.value=toUCword(this.value);"  >
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
                    <a href="/branchs" type="button" class="btn btn-warning btn-sm">
                        <i class="mdi mdi-redo-variant"></i> Back
                    </a>
                </div>
                </form>        
            </div>
        </div>
    </div>
</div> <!-- container-fluid -->
</div>


@section('scripts')
<script type="text/javascript">
function toUCword(str){
	return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
		return $1.toUpperCase();
	});
}
</script>
@endsection
