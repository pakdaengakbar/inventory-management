<?php

namespace App\Livewire\Mpaymethod;

use Livewire\Component;
use App\Helpers\MyHelper as h_;
use Livewire\Attributes\Rule;

use App\Models\mpaymethod;

class Index extends Component
{
    public $page, $id, $cstatus;
    #[Rule('required', message: 'Payment Method Harus Diisi')]
    public $cmethod;

    public function __construct() {
        $this->page  = array(
            'title' => 'Finance',
            'description'=> 'Payment',
        );
    }

    public function render()
    {
        try {
            $pageBreadcrumb = h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.mpaymethod.index', [
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
        $this->cmethod = '';
        $this->cstatus = 'Actived';
    }

    public function store()
    {

        $this->validate();
        mpaymethod::updateOrCreate(['id' => $this->id], [
            'cmethod' => $this->cmethod,
            'cstatus' => $this->cstatus,
        ]);
        $this->dispatch('editDataTable', ['message' => $this->id ? 'Data updated successfully.' : 'Data created successfully.']);
        $this->resetFields();
    }

    public function editData($id)
    {
        $data = mpaymethod::findOrFail($id);
        $this->id = $id;
        $this->cmethod = $data->cmethod;
        $this->cstatus = $data->cstatus;

    }

    public function delData($id)
    {
        mpaymethod::find($id)->delete();
        $this->dispatch('delDataTable', ['message' => 'Delete Data Successfuly..']);
    }

}
