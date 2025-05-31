<?php

namespace App\Livewire\mdepart;

use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Helpers\MyHelper as h_;
use App\Constants\Status as s_;
use App\Helpers\MyService as v_;

use App\Models\mdepart as departs;
use App\Models\mposition as positions;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $id, $deptid;
    public $page, $isOpen = 0;

    #[Rule('required', message: 'Perusahaan Harus Diisi')]
    public $ncompanie_id;

    #[Rule('required', message: 'Kode Depart Harus Diisi')]
    public $deptcode;

    #[Rule('required', message: 'Nama Depart Harus Diisi')]
    public $deptname;


    public function __construct() {
        $this->page  = array(
            'title' => 'Profile',
            'description'=> 'Data Departs',
        );
    }
    public function paginationView()
    {
        return 'vendor.pagination.bootstrap-5';
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

        $this->validate();
        departs::updateOrCreate(['id' => $this->id], [
            'ccode' => strtoupper($this->deptcode),
            'cname' => strtoupper($this->deptname),
            'ncompanie_id' => $this->ncompanie_id,
        ]);

        $this->resetPage();
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
