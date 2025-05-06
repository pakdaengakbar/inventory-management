<?php

namespace App\Livewire\Mregion;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\validate;

use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as s_;
use App\Models\Mregion;

class Formadd extends Component
{
    use WithFileUploads;
    public $numcode = '01', $uauth;

    public $page, $ccode, $cdescription, $cphone, $cemail, $clocation, $cstatus, $cbranch_manager, $cbranch_supervisor;

    public function __construct() {
        $this->page = array(
            'title' => 'Branch',
            'description'=> 'Add Data'
        );
    }
    //companyid
    #[validate('required', message: 'Cabang Perusahaan Harus Dipilih')]
    public $ncompanyid;

    //name
    #[validate('required', message: 'Nama Cabang Harus Diisi')]
    public $cname;

    //address
    #[validate('required', message: 'Alamat Perusahaan Harus Diisi')]
    #[validate('min:3', message: 'Isi Post Minimal 3 Karakter')]
    public $caddress;
    /**
     * store
     *
     * @return void
     */
    public function store()
    {
        $uauth = s_::getUser_Auth();
        //validate
        $this->validate();
        //check
        $code = s_::generateNum('mbranchs', $companyid = $this->ncompanyid);
        //create post
        $data = array(
            'ncompanyid'=> $companyid,
            'ccode'     => $code,
            'cname'     => $this->cname,
            'caddress'  => $this->caddress,
            'cdescription'  => $this->cdescription,
            'cphone'    => $this->cphone,
            'cemail'    => $this->cemail,
            'clocation' => $this->clocation,
            'cbranch_manager' => $this->cbranch_manager,
            'cbranch_supervisor' => $this->cbranch_supervisor,
            'cstatus'   => $this->cstatus,
            'ccreate_by'=> $uauth['id'],
        );
        mbranch::create($data);
        //flash message
        session()->flash('message', 'Save Successfuly');
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
            return view('livewire.mbranch.formadd', [
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
