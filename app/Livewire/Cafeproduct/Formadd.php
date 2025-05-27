<?php

namespace App\Livewire\Cafeproduct;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;

use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;
use App\Constants\Status as s_;
use App\Models\mproduct as product;

class Formadd extends Component
{
    use WithFileUploads;
    public  $page, $image;
    public  $ctype_code, $cuom_code, $nretail_value, $nwsale_value,
            $citem_code, $ccurr_code, $cwsale_unit, $cretail_unit,
            $nwsale_po_price, $nretail_po_price, $nwsale_sell_price, $nretail_sell_price,
            $dexpire_date, $clocation, $nstock_min, $nstock_max, $nopname_G1, $nopname_G2,
            $nopname_G3, $clocation1, $clocation2, $clocation3, $cmade_in,
            $COGS, $ccreate_by, $created_at, $cupdate_by, $updated_at, $csupplier_id,
            $cGroupStock, $cflag_pusat, $iPhoto, $cstatus, $ctimer;
    public $supplier, $brdgroup, $brdtype, $brdproduct, $uoms, $path;
    public $pageTitle, $pageDescription, $pageBreadcrumb;

    public function __construct() {
        $this->page = array(
            'p' => 'products/',
            't' => 'Products',
            'd' => 'Add Data'
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


    public function mount()
    {
        $this->uoms            = v_::getUom();
        $this->supplier        = v_::getSupplier();
        $this->brdgroup        = v_::getProdgroup();
        $this->brdtype         = v_::getProdtype();
        $this->brdproduct      = v_::getProdbrand();

        $this->path            = s_::URL_. $this->page['p'];
        $this->pageTitle       = $t = $this->page['t'];
        $this->pageDescription = $d = $this->page['d'];
        $this->pageBreadcrumb  = h_::setBreadcrumb($t, $d, strtolower($t));
    }
    /**
     * store
     *
     * @return void
     */
    public function store()
    {
        $uauth = v_::getUser_Auth();
        $this->validate();
        //create post
        $data = array(
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
            'ccreate_by'         => $this->ccreate_by,
            'created_at'         => $this->created_at,
            'updated_at'         => $this->updated_at,
            'csupplier_id'       => $this->csupplier_id,
            'cstatus'            => $this->cstatus,
            'ctimer'             => $this->ctimer,
            'ccreate_by'         => $uauth['id'],
        );
         if ($this->image) {
            $p_ = s_::PATH_. $this->page['path'];
            $this->image->storeAs($p_, $this->image->hashName());
            $data['iPhoto'] = $this->image->hashName();
        }
        product::create($data);
        //flash message
        session()->flash('message', 'Save Successfuly');
        //redirect
        return redirect()->route('products.index');
    }

    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        try {
            return view('livewire.cafeproduct.formadd');
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
