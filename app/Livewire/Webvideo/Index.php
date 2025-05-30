<?php

namespace App\Livewire\Webvideo;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Helpers\MyHelper as h_;

use App\Models\web_video as video;

class Index extends Component
{
    public $page;
    public $id, $cleader, $ctype, $caddress, $cphone, $cemail, $ctestimonials;

    #[Rule('required', message: 'Nama Kategori Harus Diisi')]
    public $cname;

    public function __construct() {
        $this->page  = array(
            'title' => 'Website',
            'description'=> 'video',
        );
    }

    public function render()
    {
        try {
            $pageBreadcrumb = h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.webvideo.index', [
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }

    public function createData()
    {
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->id = null;
        $this->cname = '';
        $this->cleader = '';
        $this->ctype = '';
        $this->caddress = '';
        $this->cphone = '';
        $this->cemail = '';
        $this->ctestimonials = '';
    }

    public function store()
    {
        $this->validate();
        video::updateOrCreate(['id' => $this->id], [
            'cname'  => $this->cname,
            'cleader'=> $this->cleader,
            'ctype'  => $this->ctype,
            'caddress' => $this->caddress,
            'cphone' => $this->cphone,
            'cemail' => $this->cemail,
            'ctestimonials' => $this->ctestimonials,
        ]);

        $this->dispatch('editDataTable', ['message' => $this->id ? 'Data updated successfully.' : 'Data created successfully.']);
        $this->resetFields();
    }

    public function editData($id)
    {
        $data = video::findOrFail($id);
        $this->id = $data->id;
        $this->cname = $data->cname;
        $this->cleader = $data->cleader;
        $this->ctype = $data->ctype;
        $this->caddress = $data->caddress;
        $this->cphone = $data->cphone;
        $this->cemail = $data->cemail;
        $this->ctestimonials = $data->ctestimonials;
    }

    public function delData($id)
    {
        video::find($id)->delete();
        $this->dispatch('delDataTable', ['message' => 'Delete Data Successfuly..']);
    }

}
