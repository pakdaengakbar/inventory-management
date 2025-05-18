<?php

namespace App\Livewire\Trmutationout;
use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as s_;

use App\Models\tr_mutationhdr as moheader;
use App\Models\tr_mutationdtl as modetail;

class Formedit extends Component
{
    public $page, $dtheader, $dtdetail;
    public $expedition, $region, $employee;
    public $pageTitle, $pageDescription, $pageBreadcrumb;

    public function __construct() {
        $this->page = array(
            't' => 'Mutation Out',
            'd'=> 'Edit Data'
        );
    }

    public function mount($id)
    {
        // Get Data
        $this->dtheader = moheader::find($id);
        $this->dtdetail = modetail::where('nheader_id', $id)->get();
        // Get master
        $this->region    = s_::getRegion();
        $this->expedition= s_::getExped(1);
        $this->employee  = s_::getEmployee('Actived');
        $this->pageTitle  = $t = $this->page['t'];
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
            return view('livewire.trmutationout.formedit', ['no' => 1]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
