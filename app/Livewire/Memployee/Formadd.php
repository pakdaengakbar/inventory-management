<?php

namespace App\Livewire\Memployee;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;

use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;
use App\Constants\Status as s_;

use App\Models\memployee as employee;
use App\Models\indcities as cities;

class Formadd extends Component
{
    use WithFileUploads;
    //field
    public $page, $photo;
    public  $id, $ndept_id, $cemployee_num, $caccount_num,  $caddress2, $ccity,
            $csex, $cphone, $cmobile, $cemail, $nuser_id, $cstatus, $cpost_code, $cposition,
            $cbank_account, $cbank_name, $dhire_date, $dborn_date, $cplace_of_date, $cnpwp,
            $cmarital, $ndependants, $PTKP, $creligion, $ceducation, $dentry_date,
            $ncompanie_id, $nregion_id;

    public function __construct() {
        $this->page = array(
            'path'  => 'employees/',
            'title' => 'Employees',
            'description'=> 'Add Data'
        );
    }

    //name
    #[Rule('required', message: 'Nama perusahaan Harus Diisi')]
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

        $p_ = s_::PATH_. $this->page['path'];
        $uauth = v_::getUser_Auth();

        $this->validate();
        //store image in storage/app/public/posts
        $this->image->storeAs($p_, $this->image->hashName());
        //create post
        $data = array(
            'ndept_id'      => $this->ndept_id,
            'cemployee_num' => $this->cemployee_num,
            'caccount_num'  => $this->caccount_num,
            'cname'         => $this->cname,
            'caddress1'     => $this->caddress1,
            'caddress2'     => $this->caddress2,
            'ccity'         => $this->ccity,
            'csex'          => $this->csex,
            'cphone'        => $this->cphone,
            'cmobile'       => $this->cmobile,
            'cemail'        => $this->cemail,
            'nuser_id'      => $this->nuser_id,
            'cstatus'       => $this->cstatus,
            'cpost_code'    => $this->cpost_code,
            'cposition'     => $this->cposition,
            'cbank_account' => $this->cbank_account,
            'cbank_name'    => $this->cbank_name,
            'dhire_date'    => $this->dhire_date,
            'dborn_date'    => $this->dborn_date,
            'cplace_of_date'=> $this->cplace_of_date,
            'cnpwp'         => $this->cnpwp,
            'iphoto'        => $this->iphoto,
            'cmarital'      => $this->cmarital,
            'ndependants'   => $this->ndependants,
            'PTKP'          => $this->PTKP,
            'creligion'     => $this->creligion,
            'ceducation'    => $this->ceducation,
            'dentry_date'   => $this->dentry_date,
            'ccreate_by'    => $uauth['id'],
            'ncompanie_id'  => $this->ncompanie_id,
            'nregion_id'    => $this->nregion_id,
        );

        employee::create($data);
        //flash message
        session()->flash('message', 'Save Successfuly');
        //redirect
        return redirect()->route('companies.index');
    }

    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        try {
            $cities = cities::all();
            $pageBreadcrumb =  h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.memployee.formadd', [
                'url'            => s_::URL_. $this->page['path'],
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
                'cities'         => $cities
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
