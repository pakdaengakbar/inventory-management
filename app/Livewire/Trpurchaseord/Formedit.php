<?php

namespace App\Livewire\Trpurchaseord;
use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as s_;
use App\Constants\Status as p_;

use App\Models\tr_orderhdr as oheader;
use App\Models\tr_orderdtl as odetail;

class Formedit extends Component
{
    public $page, $dtheader, $dtdetail;
    public $path, $suppliers;
    public $pageTitle, $pageDescription, $pageBreadcrumb;

    public function __construct() {
        $this->page = array(
            'p' => 'purchase/',
            't' => 'Purchase Order',
            'd'=> 'Edit Data'
        );
    }

    public function mount($id)
    {
        // Get Data
        $this->dtheader = oheader::find($id);
        $this->dtdetail = odetail::where('nheader_id', $id)->get();
         // get Master
        $this->path    = p_::URL_. $this->page['p'];
        $this->suppliers = s_::getSupplier();
        $this->pageTitle = $t  = $this->page['t'];
        $this->pageDescription = $d = $this->page['d'];
        $this->pageBreadcrumb  = h_::setBreadcrumb($t, $d, strtolower($t));
    }

    /**
     * store
     */
    public function update()
    {
        // Debugging
        // validate
    }
    /**
     * render
     */
    public function render()
    {
        try {
            return view('livewire.trpurchaseord.formedit', ['no' => 1]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
