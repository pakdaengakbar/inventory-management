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
                        <h5 class="card-title mb-0 caption fw-semibold fs-18">{{ $pageDescription }}</h5>
                    </div>
                    <div class="float-end">
                        <a href="/regions" type="button" class="btn btn-warning btn-sm">
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
                                <input type="text" class="form-control" placeholder="Id Branch" wire:model="id" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="ccode" class="form-label">Code</label>
                                <input type="text" class="form-control" placeholder="Automatic" wire:model="ccode" readonly>
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
                                <label for="cname" class="form-label">Region Name</label>
                                <input type="text" name="cname" class="form-control @error('cname') is-invalid @enderror"  placeholder="Name of Branch"  onkeyup="this.value=toUCword(this.value);" wire:model="cname">
                                @error('cname')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="caddress1" class="form-label">Address-1</label>
                                <textarea class="form-control @error('caddress1') is-invalid @enderror" wire:model="caddress1"  spellcheck="false" placeholder="Address" onkeyup="this.value=toUCword(this.value);"  ></textarea>
                                @error('caddress1')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="cphone" class="form-label">Phone</label>
                                <input type="text" class="form-control" placeholder="Phone" wire:model="cphone">
                            </div>
                            <div class="mb-3">
                                <label for="cnofax" class="form-label">Fax Number</label>
                                <input type="text" class="form-control" placeholder="Fax Number" wire:model="cnofax">
                            </div>
                            <div class="mb-3">
                                <label for="cmobile" class="form-label">Mobile</label>
                                <input type="text" class="form-control" placeholder="Mobile" wire:model="cmobile">
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
                        <hr>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="chead_branch" class="form-label">Head Branch</label>
                                <input type="text" class="form-control" placeholder="Head Branch" wire:model="chead_branch">
                            </div>
                            <div class="mb-3">
                                <label for="chead_sales" class="form-label">Head Sales</label>
                                <input type="text" class="form-control" placeholder="Head Sales" wire:model="chead_sales" onkeyup="this.value=toUCword(this.value);"  >
                            </div>
                            <div class="mb-3">
                                <label for="chead_finance" class="form-label">Head Finance</label>
                                <input type="text" class="form-control" placeholder="Head Finance" wire:model="chead_finance" onkeyup="this.value=toUCword(this.value);"  >
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="chead_service" class="form-label">Head Service</label>
                                <input type="text" class="form-control" placeholder="Head Service" wire:model="chead_service" onkeyup="this.value=toUCword(this.value);"  >
                            </div>
                            <div class="mb-3">
                                <label for="chead_part" class="form-label">Head Sparepert</label>
                                <input type="text" class="form-control" placeholder="Head Sparepert" wire:model="chead_part" onkeyup="this.value=toUCword(this.value);"  >
                            </div>
                            <div class="mb-3">
                                <label for="cstatus" class="form-label">Status</label>
                                <select class="form-select @error('cstatus') is-invalid @enderror" wire:model="cstatus" >
                                    <option value="">Select Status</option>
                                    <option value='1'>Active</option>
                                    <option value='0'>No Active</option>
                                </select>
                                @error('cstatus')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer float-end">
                    <button type="submit" id="btn_save" class="btn btn-primary btn-sm waves-effect waves-light"><i class="mdi mdi-content-save"></i> Save</button>
                    <a href="/regions" type="button" class="btn btn-warning btn-sm">
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
<script type="text/javascript">

</script>
@endsection
