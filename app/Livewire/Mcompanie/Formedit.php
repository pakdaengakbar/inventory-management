<?php

namespace App\Livewire\Mcompanie;
use Illuminate\Support\Facades\Storage;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;
use App\Constants\Status as s_;

use App\Models\mcompanie as companie;

class Formedit extends Component
{
    use WithFileUploads;

    //field
    public $page, $photo, $image;
    public $ID, $caddress2, $ccity, $ccontact, $cphone1, $cphone2, $cdefault, $cfax1, $cemail, $clogo;

    //name
     #[Rule('required', message: 'Nama perusahaan Harus Diisi')]
     public $cname;

     //address
     #[Rule('required', message: 'Alamat Perusahaan Harus Diisi')]
     #[Rule('min:3', message: 'Isi Post Minimal 3 Karakter')]
     public $caddress1;

    public function __construct() {
        $this->page = array(
            'path'  => 'companies/',
            'title' => 'Companies',
            'description'=> 'Update Data'
        );
    }
    public function mount($id)
    {
        //get post
        $data = companie::find($id);
        //assign
        $this->ID      = $data->id;
        $this->cname   = $data->cname;
        $this->caddress1 = $data->caddress1;
        $this->caddress2 = $data->caddress2;
        $this->ccity   = $data->ccity;
        $this->ccontact= $data->ccontact;
        $this->cphone1 = $data->cphone1;
        $this->cphone2 = $data->cphone2;
        $this->cfax1   = $data->cfax1;
        $this->cemail  = $data->cemail;
        $this->photo   = $data->clogo;
        $this->cdefault = $data->cdefault;
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
        $data = companie::find($this->ID);
        //check if image
        $row = array(
            'cname' => $this->cname,
            'caddress1'=> $this->caddress1,
            'caddress2'=> $this->caddress2,
            'ccity'   => $this->ccity,
            'ccontact'=> $this->ccontact,
            'cphone1' => $this->cphone1,
            'cphone2' => $this->cphone2,
            'cfax1'   => $this->cfax1,
            'cemail'  => $this->cemail,
            'cdefault'=> $this->cdefault, // Updated to use $this->cdefault
            'cupdate_by'=> $uauth['id'],
        );
        if ($this->image) {
            $p_ = s_::PATH_. $this->page['path'];
            Storage::delete($p_.$this->photo);
            //store image in storage/app/public/posts
            $this->image->storeAs($p_, $this->image->hashName());
            //update post
            $row['clogo'] = $this->image->hashName();
            $data->update($row);
        } else {
            //update post
            $data->update($row);
        }
        //flash message
        session()->flash('message', 'Update Successfuly.');
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
            $cities = v_::getCities();
            $pageBreadcrumb =  h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.mcompanie.formedit', [
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
