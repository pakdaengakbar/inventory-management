<?php

namespace App\Livewire\Mregion;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\validate;

use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as s_;
use App\Models\Mregion;

class Formedit extends Component
{
    use WithFileUploads;
    public $numcode = '01', $uauth;

    public $page, $ID, $ccode, $cdescription, $cphone, $cemail, $clocation, $cstatus, $cbranch_manager, $cbranch_supervisor;

    public function __construct() {
        $this->page = array(
            'title' => 'Branch',
            'description'=> 'Update Data'
        );
    }
    //name
    #[validate('required', message: 'Cabang Perusahaan Harus Dipilih')]
    public $ncompanyid;

    //name
    #[validate('required', message: 'Nama Cabang Harus Diisi')]
    public $cname;

    //address
    #[validate('required', message: 'Alamat Perusahaan Harus Diisi')]
    #[validate('min:3', message: 'Isi Post Minimal 3 Karakter')]
    public $caddress;

    public function mount($id)
    {
        //get post
        $data = mbranch::find($id);

        //assign
        $this->ID      = $data->id;
        $this->ncompanyid = $data->ncompanyid;
        $this->ccode   = $data->ccode;
        $this->cname   = $data->cname;
        $this->caddress= $data->caddress;
        $this->cdescription= $data->cdescription;
        $this->cemail  = $data->cemail;
        $this->cphone  = $data->cphone;
        $this->clocation = $data->clocation;
        $this->cbranch_manager = $data->cbranch_manager;
        $this->cbranch_supervisor = $data->cbranch_supervisor;
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
        $data = mbranch::find($this->ID);
        $row = array(
            'ncompanyid'=> $this->ncompanyid,
            'cname'     => $this->cname,
            'caddress'  => $this->caddress,
            'cdescription'  => $this->cdescription,
            'cphone'    => $this->cphone,
            'cemail'    => $this->cemail,
            'clocation' => $this->clocation,
            'cbranch_manager' => $this->cbranch_manager,
            'cbranch_supervisor' => $this->cbranch_supervisor,
            'cstatus'   => $this->cstatus,
            'cupdate_by'=> $uauth['id'],
        );
        $data->update($row);
        //flash message
        session()->flash('message', 'Update Successfuly.');
        //redirect
        return redirect()->route('branchs.index');
    }
    /**
     * render
     * @return void
     */
    public function render()
    {
        $company = s_::getCompany();
        try {
            $pageBreadcrumb =  h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.mbranch.formedit', [
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
                'company'      => $company,
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
