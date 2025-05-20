<?php

namespace App\Livewire\Trsalesretail;
use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as s_;
use App\Constants\Status as p_;

use App\Models\tr_dorderhdr as doheader;
use App\Models\tr_dorderdtl as dodetail;

class Formedit extends Component
{
    public $page, $path, $dtheader, $dtdetail;
    public $expedition, $region, $employee;
    public $pageTitle, $pageDescription, $pageBreadcrumb;
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
        $this->dtheader  = doheader::find($id);
        $this->dtdetail  = dodetail::where('nheader_id', $id)->get();
        // get Master
        $this->path      = p_::URL_. $this->page['p'];
        $this->region    = s_::getRegion();
        $this->expedition= s_::getExped(1);
        $this->employee  = s_::getEmployee('Actived');
        $this->pageTitle = $t  = $this->page['t'];
        $this->pageDescription = $d = $this->page['d'];
        $this->pageBreadcrumb  = h_::setBreadcrumb($t, $d, strtolower($t));
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
