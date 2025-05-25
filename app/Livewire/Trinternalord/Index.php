<?php

namespace App\Livewire\Trinternalord;

use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;
use App\Constants\Status as s_;

use App\Models\tr_inorderhdr as ioheader;
use App\Models\tr_inorderdtl as iodetail;

class Index extends Component
{
    public $page, $region;
    public $pageTitle, $pageDescription, $pageBreadcrumb;
    public function __construct() {
        $this->page  = array(
            'p' => 'intorder/',
            't' => 'Inventory',
            'd' => 'Internal Order',
        );
    }
    /**
     * mounts
     */
    public function mount()
    {
        $this->region     = v_::getRegion();
        $this->pageTitle  = $t = $this->page['t'];
        $this->pageDescription = $d = $this->page['d'];
        $this->pageBreadcrumb  = h_::setBreadcrumb($t, $d, 'inventory/', 'intorder');
    }
    public function render()
    {
        try {
            return view('livewire.trinternalord.index', ['path'=> s_::URL_. $this->page['p']]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }

    public function destroy($id, $status)
    {
        //destroy
        if ($status == 'O'){
            ioheader::destroy($id);
            iodetail::where('nheader_id', $id)->delete();
            $this->dispatch('delDataTable', ['message' => 'Delete Data Successfuly..']);
        }else{
            $this->dispatch('delDataTable', ['message' => 'Error, Data Status Close / Progress']);
        }
    }
}
