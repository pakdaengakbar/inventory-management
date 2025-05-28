<?php

namespace App\Livewire\Cafeproduct;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Storage;

use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;
use App\Constants\Status as s_;
use App\Models\mprodcafe as product;

class Formedit extends Component
{
    use WithFileUploads;
    public  $page, $image;
    public  $id, $ctype_code, $cuom_code, $nretail_value, $nwsale_value,
            $citem_code, $ccurr_code, $cwsale_unit, $cretail_unit,
            $nwsale_po_price, $nretail_po_price, $nwsale_sell_price, $nretail_sell_price,
            $dexpire_date, $clocation, $nstock_min, $nstock_max, $nopname_G1, $nopname_G2,
            $nopname_G3, $clocation1, $clocation2, $clocation3, $cmade_in,
            $COGS, $ccreate_by, $created_at, $cupdate_by, $updated_at, $csupplier_id,
            $cGroupStock, $cflag_pusat, $iPhoto, $cstatus, $ctimer;
    public $supplier, $brdgroup, $brdtype, $brdproduct, $uoms, $url;
    public $pageTitle, $pageDescription, $pageBreadcrumb;

    public function __construct() {
        $this->page = array(
            'p' => 'products/',
            't' => 'Products',
            'd' => 'Edit Data'
        );
    }

    #[Rule('required', message: 'Brand Item Harus Diisi')]
    public $cbrand_code;

    #[Rule('required', message: 'Group Item Harus Diisi')]
    public $cgroup_code;

    #[Rule('required', message: 'Barcode Harus Diisi')]
    public $nbarcode;

    //name
    #[Rule('required', message: 'Nama Product Harus Diisi')]
    public $citem_name;

    //address
    #[Rule('required', message: 'Alamat Cabang Harus Diisi')]
    #[Rule('min:3', message: 'Isi Post Minimal 3 Karakter')]
    public $cdescription;


    public function mount($id)
    {
        // Get supplier data
        $data = product::with('createby')->find($id);
        // Assign values
        $this->nbarcode        = $data->nbarcode;
        $this->cbrand_code     = $data->cbrand_code;
        $this->cgroup_code     = $data->cgroup_code;
        $this->ctype_code      = $data->ctype_code;
        $this->cuom_code       = $data->cuom_code;
        $this->nretail_value   = $data->nretail_value;
        $this->nwsale_value    = $data->nwsale_value;
        $this->citem_code      = $data->citem_code;
        $this->citem_name      = $data->citem_name;
        $this->ccurr_code      = $data->ccurr_code;
        $this->cwsale_unit     = $data->cwsale_unit;
        $this->cretail_unit    = $data->cretail_unit;
        $this->nwsale_po_price = $data->nwsale_po_price;
        $this->nretail_po_price= $data->nretail_po_price;
        $this->nwsale_sell_price  = $data->nwsale_sell_price;
        $this->nretail_sell_price = $data->nretail_sell_price;
        $this->dexpire_date    = $data->dexpire_date;
        $this->clocation       = $data->clocation;
        $this->nstock_min      = $data->nstock_min;
        $this->nstock_max      = $data->nstock_max;
        $this->nopname_G1      = $data->nopname_G1;
        $this->nopname_G2      = $data->nopname_G2;
        $this->nopname_G3      = $data->nopname_G3;
        $this->clocation1      = $data->clocation1;
        $this->clocation2      = $data->clocation2;
        $this->clocation3      = $data->clocation3;
        $this->cdescription    = $data->cdescription;
        $this->cmade_in        = $data->cmade_in;
        $this->COGS            = $data->COGS;
        $this->ccreate_by      = isset($data->createby->name) ? $data->createby->name : '';
        $this->created_at      = $data->created_at ? $data->created_at->format('m / d / Y H:i:s') : null;
        $this->cupdate_by      = isset($data->updateby->name) ? $data->updateby->name : '';
        $this->updated_at      = $data->updated_at ? $data->updated_at->format('m / d / Y H:i:s') : null;
        $this->csupplier_id    = $data->csupplier_id;
        $this->iPhoto          = $data->iPhoto;
        $this->cstatus         = $data->cstatus;
        $this->ctimer          = $data->ctimer;

        $this->uoms            = v_::getUom();
        $this->supplier        = v_::getSupplier();
        $this->brdgroup        = v_::getProdgroup();
        $this->brdtype         = v_::getProdtype();
        $this->brdproduct      = v_::getProdbrand();

        $this->url             = s_::URL_. $this->page['p'];
        $this->pageTitle       = $t = $this->page['t'];
        $this->pageDescription = $d = $this->page['d'];
        $this->pageBreadcrumb  = h_::setBreadcrumb($t, $d, strtolower($t));
    }

    /**
     * update
     *
     * @return void
     */
    public function update()
    {

        $uauth = v_::getUser_Auth();
        $this->validate();
        //get data
        $data = product::find($this->id);
        // dd($data);
        //check if image
        $row = array(
            'nbarcode'           => $this->nbarcode,
            'cbrand_code'        => $this->cbrand_code,
            'cgroup_code'        => $this->cgroup_code,
            'ctype_code'         => $this->ctype_code,
            'cuom_code'          => $this->cuom_code,
            'nretail_value'      => $this->nretail_value,
            'nwsale_value'       => $this->nwsale_value,
            'citem_code'         => $this->citem_code,
            'citem_name'         => $this->citem_name,
            'ccurr_code'         => $this->ccurr_code,
            'cwsale_unit'        => $this->cwsale_unit,
            'cretail_unit'       => $this->cretail_unit,
            'nwsale_po_price'    => $this->nwsale_po_price,
            'nretail_po_price'   => $this->nretail_po_price,
            'nwsale_sell_price'  => $this->nwsale_sell_price,
            'nretail_sell_price' => $this->nretail_sell_price,
            'dexpire_date'       => $this->dexpire_date,
            'clocation'          => $this->clocation,
            'nstock_min'         => $this->nstock_min,
            'nstock_max'         => $this->nstock_max,
            'nopname_G1'         => $this->nopname_G1,
            'nopname_G2'         => $this->nopname_G2,
            'nopname_G3'         => $this->nopname_G3,
            'clocation1'         => $this->clocation1,
            'clocation2'         => $this->clocation2,
            'clocation3'         => $this->clocation3,
            'cdescription'       => $this->cdescription,
            'cmade_in'           => $this->cmade_in,
            'csupplier_id'       => $this->csupplier_id,
            'iPhoto'             => $this->iPhoto,
            'cstatus'            => $this->cstatus,
            'ctimer'             => $this->ctimer,
            'cupdate_by'         => $uauth['id'],
        );
        // dd($row);
        //check if image
        if ($this->iPhoto && $this->image) {
            //delete old image
            $p_ = s_::PATH_. $this->page['p'];
            Storage::delete($p_.$this->iPhoto);
            //store image in storage/app/public/posts
            $this->image->storeAs($p_, $this->image->hashName());
            //update post
            $row['iPhoto'] = $this->image->hashName();
            $this->iPhoto  = $this->image->hashName();
            $this->image   = "";
        } elseif ($this->iPhoto && !$this->image) {
            //update post without image
            $row['iPhoto'] = $this->iPhoto;
        } elseif (!$this->iPhoto && !$this->image) {
            //no image update post
            $row['iPhoto'] = null;
        }

        //update post
        // Update the product with new data
        $data->update($row);
        // Optionally, you can check if the update was successful
        //flash message
        if ($data->wasChanged()) {
            session()->flash('message', 'Update Successfuly.');
        } else {
            session()->flash('message', 'No changes were made to the model.');
            //dd('No changes were made to the model.');
        }
        //redirect
        //return redirect()->route('cfproducts.index');
    }

    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        try {
            return view('livewire.cafeproduct.formedit');
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }

}
