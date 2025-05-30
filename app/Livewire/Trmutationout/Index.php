<?php

namespace App\Livewire\Trmutationout;

use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as s_;

use App\Models\tr_mutationhdr as moheader;
use App\Models\tr_mutationdtl as modetail;

class Index extends Component
{
    public $page, $region;
    public $pageTitle, $pageDescription, $pageBreadcrumb;
    public function __construct() {
        $this->page  = array(
            't' => 'Inventory',
            'd' => 'Mutation Out',
        );
    }
    public function mount()
    {
        $this->region    = s_::getRegion();
        $this->pageTitle = $t = $this->page['t'];
        $this->pageDescription = $d = $this->page['d'];
        $this->pageBreadcrumb  = h_::setBreadcrumb($t, $d, strtolower($t));

    }
    public function render()
    {
        try {
            return view('livewire.trmutationout.index');
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }

    public function destroy($id, $status)
    {
        //destroy
        if ($status == 'O'){
            moheader::destroy($id);
            modetail::where('nheader_id', $id)->delete();
            $this->dispatch('delDataTable', ['message' => 'Delete Data Successfuly..']);
        }else{
            $this->dispatch('delDataTable', ['message' => 'Error, Data Status Close / Progress']);
        }
    }
}
