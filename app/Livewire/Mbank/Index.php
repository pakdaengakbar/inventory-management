<?php

namespace App\Livewire\Mbank;

use Livewire\Component;
use App\Helpers\MyHelper as h_;
use Livewire\Attributes\Rule;

use App\Models\mbank;

class Index extends Component
{
    public $page, $id;
    #[Rule('required', message: 'Bank Code Harus Diisi')]
    public $ccode;

    #[Rule('required', message: 'Bank Name Harus Diisi')]
    public $cname;

    public function __construct() {
        $this->page  = array(
            'title' => 'Finance',
            'description'=> 'Bank',
        );
    }

    public function render()
    {
        try {
            $pageBreadcrumb = h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.mbank.index', [
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
        $this->id = '';
        $this->ccode = '';
        $this->cname = '';
    }

    public function store()
    {

        $this->validate();
        mbank::updateOrCreate(['id' => $this->id], [
            'cname' => $this->cname,
            'ccode' => $this->ccode,
        ]);
        $this->dispatch('editDataTable', ['message' => $this->id ? 'Data updated successfully.' : 'Data created successfully.']);
        $this->resetFields();
    }

    public function editData($id)
    {
        $data = mbank::findOrFail($id);
        $this->id = $id;
        $this->ccode = $data->ccode;
        $this->cname = $data->cname;

    }

    public function delData($id)
    {
        mbank::find($id)->delete();
        $this->dispatch('delDataTable', ['message' => 'Delete Data Successfuly..']);
    }

}
