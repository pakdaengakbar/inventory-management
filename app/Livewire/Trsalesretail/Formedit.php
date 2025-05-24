<?php

namespace App\Livewire\Trsalesretail;
use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as s_;
use App\Constants\Status as p_;

use App\Models\tr_saleshdr as soheader;
use App\Models\tr_salesdtl as sodetail;

class Formedit extends Component
{
    public $page, $path, $ppn;
    public $pageTitle, $pageDescription, $pageBreadcrumb;
    public $dtheader, $dtdetail;
    public function __construct() {
        $this->page = array(
            'p' => 'retail/',
            't' => 'Retail',
            'd' => 'Edit Data'
        );
    }
    public function mount($id)
    {
        // Get Data
        $this->dtheader  = soheader::find($id);
        $this->dtdetail  = sodetail::where('nheader_id', $id)->get();
        // get Master
        $this->path      = p_::URL_. $this->page['p'];
        $this->pageTitle = $t  = $this->page['t'];
        $this->pageDescription = $d = $this->page['d'];
        $this->pageBreadcrumb  = h_::setBreadcrumb($t, $d, 'sales/', strtolower($t));
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
            return view('livewire.trsalesretail.formedit', ['no' => 1]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
