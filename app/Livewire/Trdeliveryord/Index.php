<?php

namespace App\Livewire\Trdeliveryord;

use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as s_;
use App\Constants\Status as p_;

use App\Models\tr_dorderhdr as doheader;
use App\Models\tr_dorderdtl as dodetail;

class Index extends Component
{
    public $page, $path, $region;
    public $pageTitle, $pageDescription, $pageBreadcrumb;
    public function __construct() {
        $this->page  = array(
            'p' => 'delivery/',
            't' => 'Sales',
            'd' => 'Delivery',
        );
    }
    public function mount()
    {
        $this->path    = p_::URL_. $this->page['p'];
        $this->region  = s_::getRegion();
        $this->pageTitle = $t = $this->page['t'];
        $this->pageDescription = $d = $this->page['d'];
        $this->pageBreadcrumb  = h_::setBreadcrumb($t, $d, strtolower($t));
    }
    public function render()
    {
        try {
            return view('livewire.trdeliveryord.index');
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }

    public function destroy($id, $status)
    {
        //destroy
        if ($status == 'O'){
            doheader::destroy($id);
            dodetail::where('nheader_id', $id)->delete();
            $this->dispatch('delDataTable', ['message' => 'Delete Data Successfuly..']);
        }else{
            $this->dispatch('delDataTable', ['message' => 'Error, Data Status Close / Progress']);
        }
    }

}
