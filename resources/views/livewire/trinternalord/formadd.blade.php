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
                        <a href="/inventory/intorder" type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-redo-variant"></i> Back</a>
                    </div>
                </div><!-- end card header -->
                <form wire:submit="store" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row mb-3">
                                    <label for="dtrans_date" class="col-sm-2 col-form-label text-end">Date </label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control" id="trans_date" wire:model="dtrans_date" placeholder="Enter date">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="csupplier_id" class="col-sm-2 col-form-label text-end">Supplier</label>
                                    <div class="col-sm-6">
                                        <select class="form-select @error('csupplier_id') is-invalid @enderror" wire:model="csupplier_id" >
                                            <option value="">Select Supplier</option>
                                            @foreach ($suppliers as $s)
                                                <option value="{{ $s->id }}">{{ ucwords(strtolower($s->cname)) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row mb-3">
                                    <label for="cno_inorder" class="col-sm-2 col-form-label text-end">IO Number</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="cno_inorder" wire:model="cno_inorder" value="{{ $no_inorder }}"
                                         placeholder="Enter Internal Order" readonly>
                                    </div>
                                    <label for="cstatus" class="col-sm-2 col-form-label text-center">Status</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control text-center" wire:model="cstatus"  placeholder="Status" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    {!! MyHelper::setRegionlivewire('cregion_id', true, 'cregion_id') !!}
                                </div>
                            </div>

                        </div><hr>

                         <div class="row">
                            <div class="col-lg-6">
                                <div class="row mb-3">
                                    <label for="cnotes" class="col-sm-2 col-form-label text-end">Notes </label>
                                    <div class="col-sm-8">
                                       <textarea class="form-control" rows="3" wire:model="cnotes" onkeyup="this.value=toUCword(this.value);" placeholder="Enter notes"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row mb-3 justify-content-end">
                                    <label for="ntotal" class="col-sm-2 col-form-label text-end">Total </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control text-end" id="ntotal" wire:model="ntotal" placeholder="Enter Total">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer float-end">
                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">
                            <i class="mdi mdi-content-save"></i> Save
                        </button>
                        <a href="/inventory/intorder" type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-redo-variant"></i> Back</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div> <!-- container-fluid -->
</div>

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    // Set default date for dtrans_date input to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('trans_date').value = today;
});

function toUCword(str){
	return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
		return $1.toUpperCase();
	});
}
</script>
@endsection
