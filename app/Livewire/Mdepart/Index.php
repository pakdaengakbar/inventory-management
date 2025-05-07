<?php

namespace App\Livewire\Mdepart;

use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Constants\Status as s_;
use App\Helpers\MyService as v_;

use App\Models\Mdepart as departs;
use App\Models\Mposition as positions;
use Livewire\WithPagination;

class Index extends Component
{
    public $ncompanie_id, $id,  $deptid, $deptcode, $deptname;
    public $page, $isOpen = 0;

    public function __construct() {
        $this->page  = array(
            'title' => 'Profile',
            'description'=> 'Data Departs',
        );
    }

    public function render()
    {
        $departs   = departs::latest()->paginate(5);
        $positions = positions::all();
        $company= v_::getCompany();
        try {
            $pageBreadcrumb = h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.mdepart.index', [
                'path'           => s_::URL_. 'companies/',
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
                'departs'  => $departs,
                'positions'=> $positions,
                'company'=> $company,
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
        $this->deptcode = '';
        $this->deptname = '';
        $this->ncompanie_id = '';
    }

    public function store()
    {

        $this->validate([
            'deptcode' => 'required',
            'deptname' => 'required',
            'ncompanie_id' => 'required',
        ]);

        departs::updateOrCreate(['id' => $this->id], [
            'ccode' => $this->deptcode,
            'cname' => $this->deptname,
        ]);

        $this->dispatch('showAlert', ['message' => $this->id ? 'Depart updated successfully.' : 'Depart created successfully.']);
        $this->resetFields();
    }

    public function editDept($id)
    {
        $depart = departs::findOrFail($id);
        $this->id = $depart->id;
        $this->ncompanie_id = $depart->ncompanie_id;
        $this->deptcode = $depart->ccode;
        $this->deptname = $depart->cname;
    }

    public function delDept($id)
    {
        departs::find($id)->delete();
        session()->flash('message', 'Deleted successfully.');
    }

}
