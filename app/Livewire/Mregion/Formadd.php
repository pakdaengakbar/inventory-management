<?php

namespace App\Livewire\Mregion;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;

use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as s_;
use App\Models\Mregion as region;
use App\Models\indcities as cities;

class Formadd extends Component
{
    use WithFileUploads;
    public $numcode = '01', $uauth;

    public $page, $id, $nprovinces_id, $ccode, $cphone, $cmobile, $cnofax, $ccity,
           $chead_branch, $chead_sales, $chead_service, $chead_part, $chead_finance;

    public function __construct() {
        $this->page = array(
            'title' => 'Region',
            'description'=> 'Add Data'
        );
    }
    //companyid
    #[Rule('required', message: 'Cabang Perusahaan Harus Dipilih')]
    public $ncompanie_id;

     //companyid
     #[Rule('required', message: 'Status Perusahaan Harus Dipilih')]
     public $cstatus;

    //name
    #[Rule('required', message: 'Nama Cabang Harus Diisi')]
    public $cname;

    //address
    #[Rule('required', message: 'Alamat Perusahaan Harus Diisi')]
    #[Rule('min:3', message: 'Isi Post Minimal 3 Karakter')]
    public $caddress1;
    /**
     * store
     *
     * @return void
     */
    public function store()
    {
        $uauth = s_::getUser_Auth();
        //check
        $code = s_::generateNum('mregions', 'ncompanie_id', $companyid = $this->ncompanie_id);
        //validate
        $this->validate();
        //create post
        $data = array(
            'ncompanie_id'=> $this->ncompanie_id,
            'ccode'=> $code,
            'cno_register'=> $code,
            'cname'  => $this->cname,
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
            'ccreate_by'=> $uauth['id'],
        );
        region::create($data);
        //flash message
        session()->flash('message', 'Save Successfuly');
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
        $cities = cities::all();
        try {
            $pageBreadcrumb =  h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.mregion.formadd', [
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
