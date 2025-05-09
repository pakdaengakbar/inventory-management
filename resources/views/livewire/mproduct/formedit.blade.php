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
                        <a href="/master/customers" type="button" class="btn btn-warning btn-sm">
                            <i class="mdi mdi-redo-variant"></i> Back
                        </a>
                    </div>
                </div><!-- end card header -->
                <form wire:submit="update" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-1" hidden>
                                <label class="form-label">ID</label>
                                <input class="form-control" type="text"  wire:model="id" placeholder="AutoSystem" readonly>
                            </div>
                            <div class="mb-1">
                                <label for="ncompanie_id" class="form-label">Company</label>
                                <select class="form-select" wire:model="ncompanie_id">
                                    <option value="">Select Company</option>
                                    @foreach ($company as $c)
                                        <option value="{{ $c->id }}">{{ ucfirst($c->id.' - '.$c->cname) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-1">
                                <label for="cregion_id" class="form-label">Region</label>
                                <select class="form-select" wire:model="cregion_id">
                                    <option value="">Select Region</option>
                                    @foreach ($region as $c)
                                        <option value="{{ $c->id }}">{{ ucfirst($c->id.' - '.$c->cname) }}</option>
                                    @endforeach
                                </select>
                         	</div>
                            <div class="mb-1">
                                <label class="form-label">Code</label>
                                <input type="text" class="form-control" wire:model="ccode" placeholder="Automatic" readonly>
                            </div>
                            <div class="mb-1">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" wire:model="cname" onkeyup="this.value=toUCword(this.value);" placeholder="Enter name">
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
                            <div class="mb-1">
                                <label class="form-label">Address 2</label>
                                <textarea class="form-control" rows="2" wire:model="caddress2" placeholder="Enter address 2"></textarea>
                            </div>
                            <div class="mb-1">
                                <label for="cphone" class="form-label">Phone</label>
                                <div class="col-lg-12 col-xl-12">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="mdi mdi-phone-outline"></i></span>
                                        <input class="form-control" type="text"  name='cphone' placeholder="Phone"  wire:model="cphone"  aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Right column -->
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label for="cmobile" class="form-label">Mobile</label>
                                <div class="col-lg-12 col-xl-12">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="mdi mdi-phone-outline"></i></span>
                                        <input class="form-control" type="text"  name='cmobile' placeholder="Phone"  wire:model="cmobile"  aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-1">
                                <label for="cemail" class="form-label">Email Address</label>
                                <div class="col-lg-12 col-xl-12">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="mdi mdi-email"></i></span>
                                        <input type="email" class="form-control" wire:model="cemail"  placeholder="Email" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-1">
                                <label class="form-label">Fax</label>
                                <input type="text" class="form-control" wire:model="cfax" placeholder="Enter fax number">
                            </div>
                            <div class="mb-1">
                                <label class="form-label">Limit Received</label>
                                <input type="number" class="form-control" wire:model="nlimit_received" placeholder="Enter limit received" oninput="this.value = this.value.slice(0, 9);" maxlength="9">
                            </div>
                            <div class="mb-1">
                                <label class="form-label">Max Invoice</label>
                                <input type="number" class="form-control" wire:model="nmax_invoice" placeholder="Enter max invoice" oninput="this.value = this.value.slice(0, 2);" maxlength="2">
                            </div>
                            <div class="mb-1">
                                <label class="form-label">Block Due Date</label>
                                <input type="number" class="form-control" maxlength="1" wire:model="nblock_duedate" placeholder="Enter block due date" oninput="this.value = this.value.slice(0, 1);" maxlength="1">
                            </div>
                            <div class="mb-1">
                                <label class="form-label">City / Regency</label>
                                <input class="form-control" list="cityList" wire:model="ccity" placeholder="Type to search...">
                                <datalist id="cityList">
                                    @foreach ($cities as $c)
                                        <option value="{{ ucfirst(strtolower($c->name)) }}">{{ ucwords(strtolower($c->name)) }}</option>
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="mb-1">
                                <label class="form-label">Status</label>
                                <select class="form-select" wire:model="cstatus" >
                                    <option value="">Select Status</option>
                                    <option value='Customer'>Customer</option>
                                    <option value='Mitra'>Mitra</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer float-end">
                    <button type="submit"  class="btn btn-primary btn-sm waves-effect waves-light"><i class="mdi mdi-content-save"></i> Save</button>
                    <a href="/master/customers" type="button" class="btn btn-warning btn-sm">
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
