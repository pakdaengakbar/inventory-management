<?php

namespace App\Livewire\Trquotationord;
use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;

use App\Models\tr_qorderhdr as qoheader;
use App\Models\tr_qorderdtl as qodetail;

class Formedit extends Component
{
    public $page, $region, $suppliers, $employee, $dtheader, $dtdetail;
    public $pageTitle, $pageDescription, $pageBreadcrumb;
    public function __construct() {
        $this->page = array(
            't' => 'Quotation Order',
            'd' => 'Edit Data'
        );
    }

    public function mount($id)
    {
        // Get Header data
        $this->dtheader = qoheader::find($id);
        $this->dtdetail = qodetail::where('nheader_id', $id)->get();

        $this->region     = v_::getRegion();
        $this->suppliers  = v_::getSupplier();
        $this->employee   = v_::getEmployee('Actived');
        $this->pageTitle  = $t = $this->page['t'];
        $this->pageDescription = $d = $this->page['d'];
        $this->pageBreadcrumb  = h_::setBreadcrumb($t, $d, 'inventory/', 'quorder');
    }

    /**
     * store
     */
    public function update()
    {
        // Debugging ntotal value
        //validate
    }
    /**
     * render
     */
    public function render()
    {
        try {
            return view('livewire.trquotationord.formedit', ['no' => 1]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
