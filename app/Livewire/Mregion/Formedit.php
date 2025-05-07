<?php

namespace App\Livewire\Mregion;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\validate;

use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as s_;
use App\Models\Mregion as region;

class Formedit extends Component
{
    use WithFileUploads;
    public $numcode = '01', $uauth;

    public $page, $id, $nprovinces_id, $ccode, $cphone, $cmobile, $cstatus,
           $cnofax, $ccity, $chead_branch, $chead_sales, $chead_service, $chead_part, $chead_finance;

    public function __construct() {
        $this->page = array(
            'title' => 'Region',
            'description'=> 'Update Data'
        );
    }
    //name
    #[validate('required', message: 'Perusahaan Harus Dipilih')]
    public $ncompanie_id;

    //name
    #[validate('required', message: 'Nama Cabang Harus Diisi')]
    public $cname;

    //address
    #[validate('required', message: 'Alamat Perusahaan Harus Diisi')]
    #[validate('min:3', message: 'Isi Post Minimal 3 Karakter')]
    public $caddress1;



    public function mount($id)
    {
        //get post
        $data = region::find($id);
        $this->id    = $data->id;
        $this->ncompanie_id = $data->ncompanie_id;
        $this->nprovinces_id = $data->nprovinces_id;
        $this->ccode = $data->ccode;
        $this->cname = $data->cname;
        $this->caddress1= $data->caddress1;
        $this->cphone= $data->cphone;
        $this->cmobile = $data->cmobile;
        $this->cnofax= $data->cnofax;
        $this->ccity = $data->ccity;
        $this->chead_branch= $data->chead_branch;
        $this->chead_sales = $data->chead_sales;
        $this->chead_part  = $data->chead_part;
        $this->chead_service= $data->chead_service;
        $this->chead_finance = $data->chead_finance;
        $this->cstatus = $data->cstatus;
    }
    /**
     * store
     *
     * @return void
     */
    public function update()
    {
        $uauth = s_::getUser_Auth();
        //validate
        $this->validate();
        $data = region::find($this->id);
        $row = array(
            'ncompanie_id'=> $this->ncompanie_id,
            'cname'    => $this->cname,
            'caddress1'=> $this->caddress1,
            'cphone' => $this->cphone,
            'cmobile'=> $this->cmobile,
            'cnofax' => $this->cnofax,
            'ccity'  => $this->ccity,
            'chead_branch' => $this->chead_branch,
            'chead_sales'  => $this->chead_sales,
            'chead_finance'=> $this->chead_finance,
            'chead_service'=> $this->chead_service,
            'chead_part'   => $this->chead_part,
            'cstatus' => $this->cstatus,
            'cupdate_by'=> $uauth['id'],
        );
        $data->update($row);
        //flash message
        session()->flash('message', 'Update Successfuly.');
        //redirect
        return redirect()->route('regions.index');
    }
    /**
     * render
     * @return void
     */
    public function render()
    {
        $company= s_::getCompany();
        $cities = s_::getCities();
        try {
            $pageBreadcrumb =  h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.mregion.formedit', [
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
                'company' => $company,
                'cities'  => $cities,
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
