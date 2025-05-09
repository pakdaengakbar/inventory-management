<?php

namespace App\Livewire\Mproduct;

use Livewire\Component;
use Livewire\Attributes\Rule;

use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;
use App\Constants\Status as s_;
use App\Models\mproduct as product;

class Formadd extends Component
{
    public $page, $id, $nbarcode, $cbrand_code, $cgroup_code, $ctype_code, $cuom_code, $nuom_value,
            $citem_code, $citem_name, $ccurr_code, $cwsale_unit, $cretail_unit,
            $nwsale_po_price, $nretail_po_price, $nwsale_sell_price, $nretail_sell_price,
            $dexpire_date, $clocation, $nstock_min, $nstock_max, $nopname_G1, $nopname_G2,
            $nopname_G3, $clocation1, $clocation2, $clocation3, $cdescription, $cmade_in,
            $COGS, $ccreate_by, $created_at, $cupdate_by, $updated_at, $csupplier_code,
            $cGroupStock, $cflag_pusat, $iPhoto, $cstatus, $ctimer;

    public function __construct() {
        $this->page = array(
            'path'  => 'product/',
            'title' => 'Products',
            'description'=> 'Add Data'
        );
    }

    //name
    #[Rule('required', message: 'Nama Product Harus Diisi')]
    public $cname;

    //address
    #[Rule('required', message: 'Alamat Cabang Harus Diisi')]
    #[Rule('min:3', message: 'Isi Post Minimal 3 Karakter')]
    public $caddress1;

    /**
     * store
     *
     * @return void
     */
    public function store()
    {
        $p_ = s_::PATH_. $this->page['path'];
        $uauth = v_::getUser_Auth();
        $this->validate();
        //store image in storage/app/public/posts
        $this->image->storeAs($p_, $this->image->hashName());
        //create post
        $data = array(
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
            'csupplier_code'     => $this->csupplier_code,
            'cGroupStock'        => $this->cGroupStock,
            'cflag_pusat'        => $this->cflag_pusat,
            'iPhoto'             => $this->iPhoto,
            'cstatus'            => $this->cstatus,
            'ctimer'             => $this->ctimer,
            'ccreate_by'=> $uauth['id'],
        );

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
            $cities = v_::getCities();
            $company= v_::getCompany();
            $region = v_::getRegion();
            $pageBreadcrumb =  h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.mcustomer.formadd', [
                'path'           => s_::URL_. $this->page['path'],
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
                'company'=> $company,
                'region' => $region,
                'cities' => $cities,
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
