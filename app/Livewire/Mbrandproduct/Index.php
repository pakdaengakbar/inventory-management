<?php

namespace App\Livewire\Mbrandproduct;

use Livewire\Component;
use App\Helpers\MyHelper as h_;
use Livewire\Attributes\Rule;

use App\Models\mbrand_prod as brands;
use App\Models\mbrand_group as groups;
use App\Models\mbrand_type as types;

class Index extends Component
{

    public $page;
    public $id, $flag=1;

    #[Rule('required', message: 'Kode Espedisi Harus Diisi')]
    public $ccode;

    #[Rule('required', message: 'Nama Espedisi Harus Diisi')]
    public $cname;

    public function __construct() {
        $this->page  = array(
            'title' => 'Master',
            'description'=> 'Data Expedition',
        );
    }

    public function render()
    {
        $exp = brands::latest()->paginate(5);
        try {
            $pageBreadcrumb = h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.mbrandproduct.index', [
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

    public function createBrand()
    {
        $this->resetBrand();
    }

    public function resetBrand()
    {
        $this->id = null;
        $this->ccode = '';
        $this->cname = '';
    }

    public function storeBrand()
    {
        $this->validate();
        brands::updateOrCreate(['id' => $this->id], [
            'ccode' => $this->ccode,
            'cname' => $this->cname,
        ]);

        $this->dispatch('editDataBrand', ['message' => $this->id ? 'Expedition updated successfully.' : 'Expedition created successfully.']);
        $this->resetBRand();
    }

    public function editBrand($id)
    {
        $data = brands::findOrFail($id);
        $this->id = $data->id;
        $this->ccode = $data->ccode;
        $this->cname = $data->cname;
    }
    public function editGroup($id)
    {
        $data = groups::findOrFail($id);
        $this->id = $data->id;
        $this->ccode = $data->ccode;
        $this->cname = $data->cname;
    }
    public function editType($id)
    {
        $data = types::findOrFail($id);
        $this->id = $data->id;
        $this->ccode = $data->ccode;
        $this->cname = $data->cname;
    }
    public function delBrand($id)
    {
        brands::find($id)->delete();
        $this->dispatch('delDataBrand', ['message' => 'Expedition Delete successfully.']);
    }
    public function delGroup($id)
    {
        groups::find($id)->delete();
        $this->dispatch('delDataGroup', ['message' => 'Expedition Delete successfully.']);
    }
    public function delType($id)
    {
        types::find($id)->delete();
        $this->dispatch('delDataType', ['message' => 'Expedition Delete successfully.']);
    }
}
