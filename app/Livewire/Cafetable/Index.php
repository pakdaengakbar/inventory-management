<?php

namespace App\Livewire\Cafetable;

use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Constants\Status as s_;
use Livewire\Attributes\Rule;

use App\Models\cafetable;

class Index extends Component
{

    public $page, $id;
    #[Rule('required', message: 'Kode Table Harus Diisi')]
    public $ccode;

    #[Rule('required', message: 'Nama Table Harus Diisi')]
    public $cname;

    public function __construct() {
        $this->page  = array(
            'title' => 'Master',
            'description'=> 'Data Table',
        );
    }

    public function render()
    {
        $data = cafetable::all();
        try {
            $pageBreadcrumb = h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.cafetable.index', [
                'path'           => s_::URL_. 'cafetable/',
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
                'data'  => $data,
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
        $this->id = '';
        $this->ccode = '';
        $this->cname = '';
    }

    public function store()
    {

        $this->validate();
        cafetable::updateOrCreate(['id' => $this->id], [
            'cname' => $this->cname,
            'ccode' => $this->ccode,
        ]);
        $this->dispatch('editDataTable', ['message' => $this->id ? 'Data updated successfully.' : 'Data created successfully.']);
        $this->resetFields();
    }

    public function editData($id)
    {
        $data = cafetable::findOrFail($id);
        $this->id = $id;
        $this->ccode = $data->ccode;
        $this->cname = $data->cname;
    }

    public function delData($id)
    {
        cafetable::find($id)->delete();
        $this->dispatch('delDataTable', ['message' => 'Delete Data Successfuly..']);
    }

}
