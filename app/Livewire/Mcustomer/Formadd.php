<?php

namespace App\Livewire\Mcustomer;

use Livewire\Component;
use Livewire\Attributes\Rule;

use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;

use App\Models\Mcustomer as customer;

class Formadd extends Component
{
    public $page, $id, $ccode, $caddress2, $cphone, $cmobile,
           $cfax, $nlimit_received, $nmax_invoice, $nblock_duedate, $ccity,
           $ccreate_by, $cupdate_by, $ncompanie_id, $cregion_id, $caccount,
           $cstatus, $cemail;

    public function __construct() {
        $this->page = array(
            'title' => 'Customers',
            'description'=> 'Add Data'
        );
    }

    //name
    #[Rule('required', message: 'Nama Cabang Harus Diisi')]
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

        $uauth = v_::getUser_Auth();
        $this->validate();
        //create post
        $data = array(
            'ccode'            => date("ymdHis"),
            'cname'            => $this->cname,
            'caddress1'        => $this->caddress1,
            'caddress2'        => $this->caddress2,
            'cphone'           => $this->cphone,
            'cmobile'          => $this->cmobile,
            'cfax'             => $this->cfax,
            'nlimit_received'  => $this->nlimit_received,
            'nmax_invoice'     => $this->nmax_invoice,
            'nblock_duedate'   => $this->nblock_duedate,
            'ccity'            => $this->ccity,
            'ncompanie_id'     => $this->ncompanie_id,
            'cregion_id'       => $this->cregion_id,
            'caccount'         => $this->caccount,
            'cstatus'          => $this->cstatus,
            'cemail'           => $this->cemail,
            'ccreate_by'=> $uauth['id'],
            'cflag'            => 1,
        );

        customer::create($data);
        //flash message
        session()->flash('message', 'Save Successfuly');
        //redirect
        return redirect()->route('customers.index');
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
