<?php

namespace App\Livewire\Mproduct;

use Livewire\Component;
use Livewire\Attributes\Rule;

use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;
use App\Constants\Status as s_;
use App\Models\mproduct as product;

class Formedit extends Component
{
    public $page, $id, $nbarcode, $cbrand_code, $cgroup_code, $ctype_code, $cuom_code, $nuom_value,
            $citem_code, $cpart_name, $ccurr_code, $cwsale_unit, $cretail_unit,
            $nwsale_po_price, $nretail_po_price, $nwsale_sell_price, $nretail_sell_price,
            $dexpire_date, $clocation, $nstock_min, $nstock_max, $nopname_G1, $nopname_G2,
            $nopname_G3, $clocation1, $clocation2, $clocation3, $cdescription, $cmade_in,
            $COGS, $ccreate_by, $created_at, $cupdate_by, $updated_at, $csupplier_code,
            $cGroupStock, $cflag_pusat, $iPhoto, $cstatus, $ctimer;

    public function __construct() {
        $this->page = array(
            'path'  => 'product/',
            'title' => 'Products',
            'description'=> 'Update Data'
        );
    }
     //name
    #[Rule('required', message: 'Nama Cabang Harus Diisi')]
    public $cname;

    //address
    #[Rule('required', message: 'Alamat Cabang Harus Diisi')]
    #[Rule('min:3', message: 'Isi Post Minimal 3 Karakter')]
    public $caddress1;

    public function mount($id)
    {
        // Get supplier data
        $data = product::find($id);
        // Assign values
        $this->nbarcode           = $data->nbarcode;
        $this->cbrand_code        = $data->cbrand_code;
        $this->cgroup_code        = $data->cgroup_code;
        $this->ctype_code         = $data->ctype_code;
        $this->cuom_code          = $data->cuom_code;
        $this->nuom_value         = $data->nuom_value;
        $this->citem_code         = $data->citem_code;
        $this->cpart_name         = $data->cpart_name;
        $this->ccurr_code         = $data->ccurr_code;
        $this->cwsale_unit        = $data->cwsale_unit;
        $this->cretail_unit       = $data->cretail_unit;
        $this->nwsale_po_price    = $data->nwsale_po_price;
        $this->nretail_po_price   = $data->nretail_po_price;
        $this->nwsale_sell_price  = $data->nwsale_sell_price;
        $this->nretail_sell_price = $data->nretail_sell_price;
        $this->dexpire_date       = $data->dexpire_date;
        $this->clocation          = $data->clocation;
        $this->nstock_min         = $data->nstock_min;
        $this->nstock_max         = $data->nstock_max;
        $this->nopname_G1         = $data->nopname_G1;
        $this->nopname_G2         = $data->nopname_G2;
        $this->nopname_G3         = $data->nopname_G3;
        $this->clocation1         = $data->clocation1;
        $this->clocation2         = $data->clocation2;
        $this->clocation3         = $data->clocation3;
        $this->cdescription       = $data->cdescription;
        $this->cmade_in           = $data->cmade_in;
        $this->COGS               = $data->COGS;
        $this->ccreate_by         = $data->ccreate_by;
        $this->created_at         = $data->created_at;
        $this->cupdate_by         = $data->cupdate_by;
        $this->updated_at         = $data->updated_at;
        $this->csupplier_code     = $data->csupplier_code;
        $this->cGroupStock        = $data->cGroupStock;
        $this->cflag_pusat        = $data->cflag_pusat;
        $this->iPhoto             = $data->iPhoto;
        $this->cstatus            = $data->cstatus;
        $this->ctimer             = $data->ctimer;


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
        //check if image
        $row = array(
            'nbarcode'           => $this->nbarcode,
            'cbrand_code'        => $this->cbrand_code,
            'cgroup_code'        => $this->cgroup_code,
            'ctype_code'         => $this->ctype_code,
            'cuom_code'          => $this->cuom_code,
            'nuom_value'         => $this->nuom_value,
            'citem_code'         => $this->citem_code,
            'cpart_name'         => $this->cpart_name,
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
            'COGS'               => $this->COGS,
            'ccreate_by'         => $this->ccreate_by,
            'created_at'         => $this->created_at,
            'updated_at'         => $this->updated_at,
            'csupplier_code'     => $this->csupplier_code,
            'cGroupStock'        => $this->cGroupStock,
            'cflag_pusat'        => $this->cflag_pusat,
            'iPhoto'             => $this->iPhoto,
            'cstatus'            => $this->cstatus,
            'ctimer'             => $this->ctimer,
            'cupdate_by'         => $uauth['id'],
        );
        $data->update($row);
        //flash message
        session()->flash('message', 'Update Successfuly.');
        //redirect
        return redirect()->route('product.index');
    }

    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        try {
            $cities = v_::getCities();
            $company= v_::getCompany();
            $region = v_::getRegion();
            $pageBreadcrumb =  h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.mproduct.formedit', [
                'path'           => s_::URL_. $this->page['path'],
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
                'company'=> $company,
                'region' => $region,
                'cities' => $cities
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }

}
