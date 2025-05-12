<?php

namespace App\Livewire\Msupplier;

use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;

use App\Models\msupplier as supplier;

class Formadd extends Component
{
    public $page, $ccode, $ccity, $cphone, $caccount, $cstatus, $cemail;
    public function __construct() {
        $this->page = array(
            'title' => 'Supplier',
            'description'=> 'Add Data'
        );
    }

    //name
    #[Rule('required', message: 'Nama perusahaan Harus Diisi')]
    public $cname;

    //address
    #[Rule('required', message: 'Alamat Perusahaan Harus Diisi')]
    #[Rule('min:3', message: 'Isi Post Minimal 3 Karakter')]
    public $caddress;

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
        $code = v_::generateCode('msuppliers');
        if ($this->cstatus == null) {
            $this->cstatus =1;
        }
        $data = array(
            'ccode'     => $code,
            'cname'     => $this->cname,
            'caddress'  => $this->caddress,
            'ccity'     => $this->ccity,
            'cphone'    => $this->cphone,
            'cemail'    => $this->cemail,
            'caccount'  => $this->caccount,
            'cstatus'   => $this->cstatus,
            'ccreate_by'=> $uauth['id'],
        );
        supplier::create($data);
        //flash message
        session()->flash('message', 'Save Successfuly');
        //redirect
        return redirect()->route('suppliers.index');
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
            $pageBreadcrumb =  h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.msupplier.formadd', [
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
