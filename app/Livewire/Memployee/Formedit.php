<?php

namespace App\Livewire\Memployee;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Storage;

use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;
use App\Constants\Status as s_;

use App\Models\memployee as employee;

class Formedit extends Component
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

    //address
    #[Rule('required', message: 'Alamat Karyawan Harus Diisi')]
    #[Rule('min:3', message: 'Isi Post Minimal 3 Karakter')]
    public $caddress1;

    #[Rule('required', message: 'NIP Karyawan Harus Diisi')]
    public $cemployee_num;

    #[Rule('required', message: 'Absen Karyawan Harus Diisi')]
    public $caccount_num;

    public function __construct() {
        $this->page = array(
            'path'  => 'employees/',
            'title' => 'Employees',
            'description'=> 'Update Data'
        );
    }
    public function mount($id)
    {
        //get post
        $data = employee::find($id);
        //assign
        $this->ndept_id      = $data->ndept_id;
        $this->cemployee_num = $data->cemployee_num;
        $this->caccount_num  = $data->caccount_num;
        $this->cname         = $data->cname;
        $this->caddress1     = $data->caddress1;
        $this->caddress2     = $data->caddress2;
        $this->ccity         = $data->ccity;
        $this->csex          = $data->csex;
        $this->cphone        = $data->cphone;
        $this->cmobile       = $data->cmobile;
        $this->cemail        = $data->cemail;
        $this->nuser_id      = $data->nuser_id;
        $this->cpost_code    = $data->cpost_code;
        $this->nposition_id     = $data->nposition_id;
        $this->cbank_account = $data->cbank_account;
        $this->cbank_name    = $data->cbank_name;
        $this->dhire_date    = $data->dhire_date;
        $this->dborn_date    = $data->dborn_date;
        $this->cplace_of_date = $data->cplace_of_date;
        $this->cnpwp         = $data->cnpwp;
        $this->photo         = $data->iphoto;
        $this->cmarital      = $data->cmarital;
        $this->ndependants   = $data->ndependants;
        $this->PTKP          = $data->PTKP;
        $this->creligion     = $data->creligion;
        $this->ceducation    = $data->ceducation;
        $this->dentry_date   = $data->dentry_date;
        $this->ncompanie_id  = $data->ncompanie_id;
        $this->cstatus       = $data->cstatus;
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
        $data = employee::find($this->id);
        //check if image
        $row = array(
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
            'cupdate_by'    => $uauth['id'],
            'ncompanie_id'  => $this->ncompanie_id,
        );
        if ($this->image) {
            $p_ = s_::PATH_. $this->page['path'];
            Storage::delete($p_.$this->photo);
            //store image in storage/app/public/posts
            $this->image->storeAs($p_, $this->image->hashName());
            //update post
            $row['iphoto'] = $this->image->hashName();
            $data->update($row);
        } else {
            //update post
            $data->update($row);
        }
        //flash message
        session()->flash('message', 'Update Successfuly.');
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
            return view('livewire.memployee.formedit', [
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
