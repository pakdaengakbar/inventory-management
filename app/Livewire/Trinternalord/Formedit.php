<?php

namespace App\Livewire\Trinternalord;
use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;

use App\Models\tr_inorderhdr as ioheader;
use App\Models\tr_inorderdtl as iodetail;

class Formedit extends Component
{
    public $page, $region, $suppliers, $dtheader, $dtdetail;
    public $pageTitle, $pageDescription, $pageBreadcrumb;
    public function __construct() {
        $this->page = array(
            't' => 'Internal Order',
            'd' => 'Edit Data'
        );
    }

    public function mount($id)
    {
        // Get Data
        $this->dtheader = ioheader::find($id);
        $this->dtdetail = iodetail::where('nheader_id', $id)->get();

        $this->region     = v_::getRegion();
        $this->suppliers  = v_::getSupplier();
        $this->pageTitle  = $t = $this->page['t'];
        $this->pageDescription = $d = $this->page['d'];
        $this->pageBreadcrumb  = h_::setBreadcrumb($t, $d, 'inventory/', 'intorder');
    }
    /**
     * store
     */
    public function update()
    {
        // Debugging ntotal value
        // validate
    }
    /**
     * render
     */
    public function render()
    {
        try {
            return view('livewire.trinternalord.formedit', ['no' => 1,'suppliers'=> v_::getSupplier()]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
