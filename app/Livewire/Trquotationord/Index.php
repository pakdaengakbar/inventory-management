<?php

namespace App\Livewire\Trquotationord;

use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;
use App\Constants\Status as s_;

use App\Models\tr_qorderhdr as qoheader;
use App\Models\tr_qorderhdr as qodetail;

class Index extends Component
{
    public $page, $region;
    public $pageTitle, $pageDescription, $pageBreadcrumb;
    public function __construct() {
        $this->page  = array(
            'p' => 'quorder/',
            't' => 'Inventory',
            'd' => 'Quotation Order',
        );
    }
    public function mount()
    {
        $this->region     = v_::getRegion();
        $this->pageTitle  = $t = $this->page['t'];
        $this->pageDescription = $d = $this->page['d'];
        $this->pageBreadcrumb  = h_::setBreadcrumb($t, $d, 'inventory/', 'quorder');
    }
    public function render()
    {
        try {
            return view('livewire.trquotationord.index');
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }

    public function destroy($id)
    {
        //destroy
        qoheader::destroy($id);
        qodetail::where('nheader_id', $id)->delete();
        $this->dispatch('delDataTable', ['message' => 'Delete Data Successfuly..']);
    }
}
