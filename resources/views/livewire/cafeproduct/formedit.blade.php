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
                        <a href="/cafe/products" type="button" class="btn btn-warning btn-sm">
                            <i class="mdi mdi-redo-variant"></i> Back
                        </a>
                    </div>
                </div><!-- end card header -->
                <form wire:submit="update" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <div class="mb-2" hidden>
                                <label class="form-label">ID</label>
                                <input class="form-control" type="text"  wire:model="id" placeholder="AutoSystem" readonly>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Barcode</label>
                                <input class="form-control @error('nbarcode') is-invalid @enderror" type="text" wire:model="nbarcode" placeholder="Enter barcode">
                                @error('nbarcode')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Item Code</label>
                                <input type="text" class="form-control @error('citem_code') is-invalid @enderror" wire:model="citem_code" placeholder="Enter item code">
                                @error('citem_code')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Item Name</label>
                                <input type="text" class="form-control @error('citem_name') is-invalid @enderror" wire:model="citem_name" placeholder="Enter item name">
                                @error('citem_name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Description</label>
                                <textarea class="form-control @error('cdescription') is-invalid @enderror" wire:model="cdescription" placeholder="Enter description"></textarea>
                                @error('cdescription')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label class="form-label">UOM Code</label>
                                <select class="form-select" wire:model="cuom_code" >
                                    <option value="">Select Status</option>
                                    @foreach ($uoms as $c)
                                        <option value="{{ $c->ccode }}">{{ ucwords(strtolower($c->cname)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Right column -->
                        <div class="col-lg-6 mb-2">
                            <div class="mb-3">
                                <label for="cbrand_code" class="form-label">Brand Product</label>
                                <select class="form-select @error('cbrand_code') is-invalid @enderror" wire:model="cbrand_code" >
                                    <option value="" disabled>Select Brand</option>
                                    @foreach ($brdproduct as $c)
                                        <option value="{{ $c->id }}">{{ ucwords(strtolower($c->cname)) }}</option>
                                    @endforeach
                                </select>
                                @error('cbrand_code')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="cgroup_code" class="form-label">Group Product</label>
                                <select class="form-select @error('cgroup_code') is-invalid @enderror" wire:model="cgroup_code" >
                                    <option value="" disabled>Select Group</option>
                                    @foreach ($brdgroup as $c)
                                        <option value="{{ $c->id }}">{{ ucwords(strtolower($c->cname)) }}</option>
                                    @endforeach
                                </select>
                                @error('cgroup_code')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="ctype_code" class="form-label">Type Product</label>
                                <select class="form-select" wire:model="ctype_code" >
                                    <option value="" disabled>Select Type</option>
                                    @foreach ($brdtype as $c)
                                        <option value="{{ $c->id }}">{{ ucwords(strtolower($c->cname)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Currency</label>
                                <select class="form-select" wire:model="ccurr_code" >
                                    <option value="" disabled>Select Currency</option>
                                    <option value='IDR'>IDR</option>
                                    <option value='DOLLAR'>DOLLAR</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Type Menu</label>
                                <select class="form-select" wire:model="cmade_in" >
                                    <option value="" disabled>Select Made In</option>
                                    <option value='APPETIZER'>APPETIZER</option>
                                    <option value='COFFEE'>COFFEE</option>
                                    <option value='DRINK'>DRINK</option>
                                    <option value='DESSERT'>DESSERT</option>
                                    <option value='SNACK'>SNACK</option>
                                    <option value='MAIN_COURSE'>MAIN COURSE</option>
                                    <option value='KETO'>KETO</option>
                                    <option value='FRENCH_TOAST'>FRENCH TOAST</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <div class="silva-main-sections">
                                    <div class="silva-profile-main">
                                        @if ($iPhoto)
                                        <img src="{{ asset($url.$iPhoto) }}" alt="Image" class="rounded-circle img-fluid avatar-xl img-thumbnail float-start" width='10%' id='file_image'>
                                        @else
                                        <img src="{{ asset($no_img) }}" alt="Image" class="rounded-circle img-fluid avatar-xl img-thumbnail float-start" width='10%' id='file_image'>
                                        @endif
                                    </div>
                                    <div class="overflow-hidden ms-md-4 ms-0">
                                        <p class="my-1 text-muted fs-16">Image Item</p>
                                        <span class="fs-15"><i class="mdi mdi-message me-2 align-middle"></i>{{ $citem_name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="ccontact" class="form-label">File Image</label>
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
                        </div>

                        <h5 class="card-title mb-3">Unit Of Material</h5>
                        <!-- Item Price -->
                        <div class="col-lg-6 mb-2">
                            <div class="mb-2">
                                <label class="form-label">Wholesale Unit</label>
                                <select class="form-select" wire:model="cwsale_unit" >
                                    <option value="">Select Unit</option>
                                    @foreach ($uoms as $c)
                                        <option value="{{ $c->ccode }}">{{ ucwords(strtolower($c->cname)) }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="mb-2">
                                <label class="form-label">Retail Unit</label>
                                <select class="form-select" wire:model="cretail_unit" >
                                    <option value="">Select Unit</option>
                                    @foreach ($uoms as $c)
                                        <option value="{{ $c->ccode }}">{{ ucwords(strtolower($c->cname)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-2">
                            <div class="mb-2">
                                <label class="form-label">Expire Date</label>
                                <input type="date" class="form-control" wire:model="dexpire_date">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" wire:model="clocation" placeholder="Enter location">
                            </div>
                        </div>

                        <h5 class="card-title mb-3">Price</h5>
                        <!-- Item Price -->
                        <div class="col-lg-6 mb-2">
                            <div class="mb-2">
                                <label class="form-label">Retail PO Price</label>
                                <input type="number" class="form-control" wire:model="nretail_po_price" placeholder="Enter retail PO price">
                            </div>
                        </div>
                        <div class="col-lg-6 mb-2">
                            <div class="mb-2">
                                <label class="form-label">Retail Sell Price</label>
                                <input type="number" class="form-control" wire:model="nretail_sell_price" placeholder="Enter retail sell price">
                            </div>
                        </div>
                        <!-- Opname Location -->

                        <!-- user update -->
                        <h5 class="card-title mb-3">Create / Update By</h5>
                        <div class="col-lg-6">
                             <div class="mb-2">
                                <label class="form-label">Created By</label>
                                <input readonly type="text" class="form-control bg-light" wire:model="ccreate_by" placeholder="Creator">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Created At</label>
                                <input readonly type="text" class="form-control bg-light" wire:model="created_at">
                            </div>
                        </div>
                        <!-- Opname Location -->
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label class="form-label">Updated By</label>
                                <input readonly type="text" class="form-control bg-light" wire:model="cupdate_by" placeholder="Updater">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Updated At</label>
                                <input readonly type="text" class="form-control bg-light" wire:model="updated_at">
                            </div>
                        </div>
                        <h5 class="card-title mb-3">Stock</h5>
                        <!-- Item Price -->
                        <div class="col-lg-6 mb-2">
                             <div class="mb-2">
                                <label class="form-label">Stock Min</label>
                                <input type="number" class="form-control" wire:model="nstock_min" placeholder="Enter stock min">
                            </div>
                        </div>
                        <div class="col-lg-6 mb-2">
                             <div class="mb-2">
                                <label class="form-label">Stock Max</label>
                                <input type="number" class="form-control" wire:model="nstock_max" placeholder="Enter stock max">
                            </div>
                        </div>
                        <h5 class="card-title mb-3">Other</h5>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label class="form-label">Status</label>
                                <select class="form-select" wire:model="cstatus" >
                                    <option value="">Select Status</option>
                                    <option value='1'>Actived</option>
                                    <option value='0'>Not Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label class="form-label">Timer</label>
                                <input readonly type="text" class="form-control  bg-light" wire:model="ctimer" placeholder="Enter timer">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer float-end">
                    <button type="submit"  class="btn btn-primary btn-sm waves-effect waves-light">
                        <i class="mdi mdi-content-save"></i> Update</button>
                    <a href="/cafe/products" type="button" class="btn btn-warning btn-sm">
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

</script>
@endsection
