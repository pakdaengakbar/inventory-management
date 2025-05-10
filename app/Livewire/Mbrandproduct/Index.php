<?php

namespace App\Livewire\Mbrandproduct;

use Livewire\Component;
use App\Helpers\MyHelper as h_;
use Livewire\Attributes\Rule;

use App\Models\mbrandproduct as expedition;

class Index extends Component
{

    public $page;
    public $id, $cflag;

    #[Rule('required', message: 'Kode Espedisi Harus Diisi')]
    public $ccode;

    #[Rule('required', message: 'Nama Espedisi Harus Diisi')]
    public $cname;

    #[Rule('required', message: 'Keterangan Espedisi Harus Diisi')]
    public $cnote;

    public function __construct() {
        $this->page  = array(
            'title' => 'Master',
            'description'=> 'Data Expedition',
        );
    }

    public function render()
    {
        $exp = expedition::latest()->paginate(5);
        try {
            $pageBreadcrumb = h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.mprodsetting.index', [
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
                'exp'  => $exp,
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }

    }

    public function createDepart()
    {
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->id = null;
        $this->ccode = '';
        $this->cname = '';
        $this->cnote = '';
        $this->cflag = '';
    }

    public function store()
    {

        $this->validate();
        expedition::updateOrCreate(['id' => $this->id], [
            'ccode' => $this->ccode,
            'cname' => $this->cname,
            'cnote' => $this->cnote,
            'cflag' => 0,
        ]);

        $this->dispatch('editDataTable', ['message' => $this->id ? 'Expedition updated successfully.' : 'Expedition created successfully.']);
        $this->resetFields();
    }

    public function editExp($id)
    {
        $data = expedition::findOrFail($id);
        $this->id = $data->id;
        $this->ccode = $data->ccode;
        $this->cname = $data->cname;
        $this->cnote = $data->cnote;
        $this->cflag = $data->cflag;
    }

    public function delExp($id)
    {
        expedition::find($id)->delete();
        $this->dispatch('delDataTable', ['message' => 'Expedition Delete successfully.']);
    }

}
