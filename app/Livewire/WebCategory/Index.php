<?php

namespace App\Livewire\WebCategory;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Helpers\MyHelper as h_;

use App\Models\web_category as category;

class Index extends Component
{
    public $page;
    public $id, $corder, $ctype;

    #[Rule('required', message: 'Nama Kategori Harus Diisi')]
    public $cname;

    public function __construct() {
        $this->page  = array(
            'title' => 'Website',
            'description'=> 'Category',
        );
    }

    public function render()
    {
        try {
            $pageBreadcrumb = h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.web-category.index', [
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
        $this->ctype = '';
        $this->corder = '';
    }

    public function store()
    {
        $this->validate();
        category::updateOrCreate(['id' => $this->id], [
            'cname' => $this->cname,
            'cslug' => Str::slug($this->cname),
            'corder' => $this->corder,
            'ctype' => $this->ctype,
            'chits' => 0,
        ]);

        $this->dispatch('editDataTable', ['message' => $this->id ? 'Data updated successfully.' : 'Data created successfully.']);
        $this->resetFields();
    }

    public function editData($id)
    {
        $data = category::findOrFail($id);
        $this->id = $data->id;
        $this->cname = $data->cname;
        $this->corder = $data->corder;
        $this->ctype = $data->ctype;
    }

    public function delData($id)
    {
        category::find($id)->delete();
        $this->dispatch('delDataTable', ['message' => 'Data Delete successfully.']);
    }

}
