<?php

namespace App\Livewire\Msupplier;
use Livewire\Component;
use Livewire\Attributes\Rule;

use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as s_;
use App\Models\msupplier as supplier;

class Formedit extends Component
{
    public $page, $id, $ccode, $ccity, $cphone, $caccount, $cstatus, $cemail;
    public function __construct() {
        $this->page = array(
            'title' => 'Supplier',
            'description'=> 'Update Data'
        );
    }
     //name
    #[Rule('required', message: 'Nama perusahaan Harus Diisi')]
    public $cname;

    //address
    #[Rule('required', message: 'Alamat Perusahaan Harus Diisi')]
    #[Rule('min:3', message: 'Isi Post Minimal 3 Karakter')]
    public $caddress;


    public function mount($id)
    {
        // Get supplier data
        $data = supplier::find($id);
        // Assign values
        $this->id    = $data->id;
        $this->ccode    = $data->ccode;
        $this->cname    = $data->cname;
        $this->caddress = $data->caddress;
        $this->ccity    = $data->ccity;
        $this->cphone   = $data->cphone;
        $this->cemail   = $data->cemail;
        $this->caccount = $data->caccount;
        $this->cstatus  = $data->cstatus;
    }

    /**
     * update
     *
     * @return void
     */
    public function update()
    {
        $uauth = s_::getUser_Auth();
        $this->validate();
        //get data
        $data = supplier::find($this->id);
        //check if image
        $row = array(
            'ccode'     => $this->ccode,
            'cname'     => $this->cname,
            'caddress'  => $this->caddress,
            'ccity'     => ucwords(strtolower($this->ccity)),
            'cphone'    => $this->cphone,
            'cemail'    => $this->cemail,
            'caccount'  => $this->caccount,
            'cstatus'   => $this->cstatus,
            'cupdate_by'=> $uauth['id'],
        );
        $data->update($row);
        //flash message
        session()->flash('message', 'Update Successfuly.');
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
            $cities = s_::getCities();
            $pageBreadcrumb =  h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.msupplier.formedit', [
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
                'cities'         => $cities,
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }

}
