<?php

namespace App\Livewire\Mcompanie;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\validate;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;
use App\Constants\Status as s_;

use App\Models\mcompanie as companie;

class Formadd extends Component
{
    use WithFileUploads;
    public $page, $photo;
    public $caddress1, $caddress2, $ccity, $ccontact, $cphone1, $cphone2, $cdefault, $cfax1, $cfax2, $cemail, $clogo;

    public function __construct() {
        $this->page = array(
            'path'  => 'companies/',
            'title' => 'Companies',
            'description'=> 'Add Data'
        );
    }

    //image
    #[validate('required', message: 'Masukkan Gambar Logo')]
    #[validate('image', message: 'File Harus Gambar')]
    #[validate('max:1024', message: 'Ukuran File Maksimal 1MB')]
    public $image;

    //name
    #[validate('required', message: 'Nama perusahaan Harus Diisi')]
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
        $p_ = s_::PATH_. 'companies/';
        $uauth = v_::getUser_Auth();

        $this->validate();
        //store image in storage/app/public/posts
        $this->image->storeAs($p_, $this->image->hashName());
        //create post
        $data = array(
            'cname'    => $this->cname,
            'caddress1'=> $this->caddress1,
            'caddress2'=> $this->caddress2,
            'ccity'    => $this->ccity,
            'ccontact' => $this->ccontact,
            'cphone1'  => $this->cphone1,
            'cphone2'  => $this->cphone2,
            'cfax1'    => $this->cfax1,
            'cfax2'    => $this->cfax2,
            'cemail'   => $this->cemail,
            'cdefault' => $this->cdefault,
            'cimage'   => $this->image->hashName(),
            'ccreate_by'=> $uauth['id'],
        );
        companie::create($data);
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
            $pageBreadcrumb =  h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.mcompanie.formadd', [
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
