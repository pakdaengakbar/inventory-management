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
                        <a href="/master/products" type="button" class="btn btn-warning btn-sm">
                            <i class="mdi mdi-redo-variant"></i> Back
                        </a>
                    </div>
                </div><!-- end card header -->
                <form wire:submit="store" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="id" class="form-label">ID</label>
                                    <input type="text" class="form-control" wire:model="id" placeholder="Automatic" readonly>
                                </div>
                                <div class="mb-2">
                                    <label for="nbarcode" class="form-label">Barcode</label>
                                    <input type="text" class="form-control" wire:model="nbarcode" placeholder="Enter barcode">
                                </div>
                                <div class="mb-2">
                                    <label for="cbrand_code" class="form-label">Brand Code</label>
                                    <input type="text" class="form-control" wire:model="cbrand_code" placeholder="Enter brand code">
                                </div>
                                <div class="mb-2">
                                    <label for="cgroup_code" class="form-label">Group Code</label>
                                    <input type="text" class="form-control" wire:model="cgroup_code" placeholder="Enter group code">
                                </div>
                                <div class="mb-2">
                                    <label for="ctype_code" class="form-label">Type Code</label>
                                    <input type="text" class="form-control" wire:model="ctype_code" placeholder="Enter type code">
                                </div>
                                <div class="mb-2">
                                    <label for="cuom_code" class="form-label">UOM Code</label>
                                    <input type="text" class="form-control" wire:model="cuom_code" placeholder="Enter UOM code">
                                </div>
                                <div class="mb-2">
                                    <label for="nuom_value" class="form-label">UOM Value</label>
                                    <input type="number" class="form-control" wire:model="nuom_value" placeholder="Enter UOM value">
                                </div>
                                <div class="mb-2">
                                    <label for="citem_code" class="form-label">Item Code</label>
                                    <input type="text" class="form-control" wire:model="citem_code" placeholder="Enter item code">
                                </div>
                                <div class="mb-2">
                                    <label for="cpart_name" class="form-label">Part Name</label>
                                    <input type="text" class="form-control" wire:model="cpart_name" placeholder="Enter part name">
                                </div>
                                <div class="mb-2">
                                    <label for="ccurr_code" class="form-label">Currency Code</label>
                                    <input type="text" class="form-control" wire:model="ccurr_code" placeholder="Enter currency code">
                                </div>
                                <div class="mb-2">
                                    <label for="cwsale_unit" class="form-label">Wholesale Unit</label>
                                    <input type="text" class="form-control" wire:model="cwsale_unit" placeholder="Enter wholesale unit">
                                </div>
                                <div class="mb-2">
                                    <label for="cretail_unit" class="form-label">Retail Unit</label>
                                    <input type="text" class="form-control" wire:model="cretail_unit" placeholder="Enter retail unit">
                                </div>
                                <div class="mb-2">
                                    <label for="nwsale_po_price" class="form-label">Wholesale PO Price</label>
                                    <input type="number" class="form-control" wire:model="nwsale_po_price" placeholder="Enter wholesale PO price">
                                </div>
                                <div class="mb-2">
                                    <label for="nretail_po_price" class="form-label">Retail PO Price</label>
                                    <input type="number" class="form-control" wire:model="nretail_po_price" placeholder="Enter retail PO price">
                                </div>
                                <div class="mb-2">
                                    <label for="nwsale_sell_price" class="form-label">Wholesale Sell Price</label>
                                    <input type="number" class="form-control" wire:model="nwsale_sell_price" placeholder="Enter wholesale sell price">
                                </div>
                                <div class="mb-2">
                                    <label for="nretail_sell_price" class="form-label">Retail Sell Price</label>
                                    <input type="number" class="form-control" wire:model="nretail_sell_price" placeholder="Enter retail sell price">
                                </div>
                                <div class="mb-2">
                                    <label for="dexpire_date" class="form-label">Expire Date</label>
                                    <input type="date" class="form-control" wire:model="dexpire_date">
                                </div>
                                <div class="mb-2">
                                    <label for="clocation" class="form-label">Location</label>
                                    <input type="text" class="form-control" wire:model="clocation" placeholder="Enter location">
                                </div>
                                <div class="mb-2">
                                    <label for="nstock_min" class="form-label">Stock Min</label>
                                    <input type="number" class="form-control" wire:model="nstock_min" placeholder="Enter minimum stock">
                                </div>
                                <div class="mb-2">
                                    <label for="nstock_max" class="form-label">Stock Max</label>
                                    <input type="number" class="form-control" wire:model="nstock_max" placeholder="Enter maximum stock">
                                </div>
                                <div class="mb-2">
                                    <label for="nopname_G1" class="form-label">Opname G1</label>
                                    <input type="number" class="form-control" wire:model="nopname_G1" placeholder="Enter opname G1">
                                </div>
                                <div class="mb-2">
                                    <label for="nopname_G2" class="form-label">Opname G2</label>
                                    <input type="number" class="form-control" wire:model="nopname_G2" placeholder="Enter opname G2">
                                </div>
                                <div class="mb-2">
                                    <label for="nopname_G3" class="form-label">Opname G3</label>
                                    <input type="number" class="form-control" wire:model="nopname_G3" placeholder="Enter opname G3">
                                </div>
                                <div class="mb-2">
                                    <label for="clocation1" class="form-label">Location 1</label>
                                    <input type="text" class="form-control" wire:model="clocation1" placeholder="Enter location 1">
                                </div>
                                <div class="mb-2">
                                    <label for="clocation2" class="form-label">Location 2</label>
                                    <input type="text" class="form-control" wire:model="clocation2" placeholder="Enter location 2">
                                </div>
                                <div class="mb-2">
                                    <label for="clocation3" class="form-label">Location 3</label>
                                    <input type="text" class="form-control" wire:model="clocation3" placeholder="Enter location 3">
                                </div>
                                <div class="mb-2">
                                    <label for="cdescription" class="form-label">Description</label>
                                    <textarea class="form-control" rows="3" wire:model="cdescription" placeholder="Enter description"></textarea>
                                </div>
                                <div class="mb-2">
                                    <label for="cmade_in" class="form-label">Made In</label>
                                    <input type="text" class="form-control" wire:model="cmade_in" placeholder="Enter country of origin">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="COGS" class="form-label">COGS</label>
                                    <input type="number" class="form-control" wire:model="COGS" placeholder="Enter COGS">
                                </div>
                                <div class="mb-2">
                                    <label for="ccreate_by" class="form-label">Created By</label>
                                    <input type="text" class="form-control" wire:model="ccreate_by" readonly>
                                </div>
                                <div class="mb-2">
                                    <label for="created_at" class="form-label">Created At</label>
                                    <input type="datetime-local" class="form-control" wire:model="created_at" readonly>
                                </div>
                                <div class="mb-2">
                                    <label for="cupdate_by" class="form-label">Updated By</label>
                                    <input type="text" class="form-control" wire:model="cupdate_by" readonly>
                                </div>
                                <div class="mb-2">
                                    <label for="updated_at" class="form-label">Updated At</label>
                                    <input type="datetime-local" class="form-control" wire:model="updated_at" readonly>
                                </div>
                                <div class="mb-2">
                                    <label for="csupp_code" class="form-label">Supplier Code</label>
                                    <input type="text" class="form-control" wire:model="csupp_code" placeholder="Enter supplier code">
                                </div>
                                <div class="mb-2">
                                    <label for="cGroupStock" class="form-label">Group Stock</label>
                                    <input type="text" class="form-control" wire:model="cGroupStock" placeholder="Enter group stock">
                                </div>
                                <div class="mb-2">
                                    <label for="cflag_pusat" class="form-label">Flag Pusat</label>
                                    <input type="text" class="form-control" wire:model="cflag_pusat" placeholder="Enter flag pusat">
                                </div>
                                <div class="mb-2">
                                    <label for="iPhoto" class="form-label">Photo</label>
                                    <input type="file" class="form-control" wire:model="iPhoto">
                                </div>
                                <div class="mb-2">
                                    <label for="cstatus" class="form-label">Status</label>
                                    <input type="text" class="form-control" wire:model="cstatus" placeholder="Enter status">
                                </div>
                                <div class="mb-2">
                                    <label for="ctimer" class="form-label">Timer</label>
                                    <input type="text" class="form-control" wire:model="ctimer" placeholder="Enter timer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer float-end">
                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">
                            <i class="mdi mdi-content-save"></i> Save
                        </button>
                        <a href="/master/products" type="button" class="btn btn-warning btn-sm">
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
