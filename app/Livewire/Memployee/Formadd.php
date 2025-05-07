<?php

namespace App\Livewire\Memployee;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;

use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;
use App\Constants\Status as s_;

use App\Models\memployee as employee;

class Formadd extends Component
{
    use WithFileUploads;
    //field
    public $page, $photo, $image;
    public  $id, $caddress2, $ccity, $csex, $cphone, $cmobile, $cemail, $nuser_id, $cstatus, $cpost_code,
            $cbank_account, $cbank_name, $dhire_date, $dborn_date, $cplace_of_date, $cnpwp,
            $cmarital, $ndependants, $PTKP, $creligion, $ceducation, $dentry_date;

    #[Rule('required', message: 'Perusahaan Harus Dipilih')]
    public $ncompanie_id;

    #[Rule('required', message: 'Departemen Harus Dipilih')]
    public $ndept_id;

    #[Rule('required', message: 'Jabatan Harus Dipilih')]
    public $nposition_id;
    //name
    #[Rule('required', message: 'Nama Karyawan Harus Diisi')]
    public $cname;

    #[Rule('required', message: 'NIP Karyawan Harus Diisi')]
    public $cemployee_num;

    #[Rule('required', message: 'Absen Karyawan Harus Diisi')]
    public $caccount_num;

    //address
    #[Rule('required', message: 'Alamat Karyawan Harus Diisi')]
    #[Rule('min:3', message: 'Isi Post Minimal 3 Karakter')]
    public $caddress1;

    public function __construct() {
        $this->page = array(
            'path'  => 'employees/',
            'title' => 'Employees',
            'description'=> 'Add Data'
        );
    }

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
            'nposition_id'     => $this->nposition_id,
            'cbank_account' => $this->cbank_account,
            'cbank_name'    => $this->cbank_name,
            'dhire_date'    => $this->dhire_date,
            'dborn_date'    => $this->dborn_date,
            'cplace_of_date'=> $this->cplace_of_date,
            'cnpwp'         => $this->cnpwp,
            'cmarital'      => $this->cmarital,
            'ndependants'   => $this->ndependants,
            'PTKP'          => $this->PTKP,
            'creligion'     => $this->creligion,
            'ceducation'    => $this->ceducation,
            'dentry_date'   => $this->dentry_date,
            'ccreate_by'    => $uauth['id'],
            'ncompanie_id'  => $this->ncompanie_id,
            'iphoto'        => $this->image->hashName(),
        );

        employee::create($data);
        //flash message
        session()->flash('message', 'Save Successfuly');
        //redirect
        return redirect()->route('employees.index');
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
            $depart = v_::getDepart();
            $position = v_::getPosition();
            $company= v_::getCompany();
            $pageBreadcrumb =  h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.memployee.formadd', [
                'url'            => s_::URL_. $this->page['path'],
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
                'company' => $company,
                'cities'  => $cities,
                'depart'  => $depart,
                'position'=> $position,
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
