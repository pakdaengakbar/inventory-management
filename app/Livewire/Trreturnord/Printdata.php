<?php

namespace App\Livewire\Trreturnord;

use Livewire\Component;
use App\Helpers\MyHelper as h_;

use App\Models\tr_dorderhdr as doheader;
use App\Models\tr_dorderdtl as dodetail;

class Printdata extends Component
{
    public $no=1;
    public $page, $dtheader, $dtdetail;
    public $pageTitle, $pageDescription, $pageBreadcrumb;
    public function __construct() {
        $this->page  = array(
            'p' => 'delivery/',
            't' => 'Delivery',
            'd'=> 'Print',
        );
    }
    public function mount($id)
    {
        // Get Header data
        $this->dtheader = doheader::find($id);
        $this->dtdetail = dodetail::where('nheader_id', $id)->get();

        $this->pageTitle = $t  = $this->page['t'];
        $this->pageDescription = $d = $this->page['d'];
        $this->pageBreadcrumb  = h_::setBreadcrumb($t, $d, strtolower($t));
    }
    public function render()
    {
        try {
            return view('livewire.trreturnord.printdata');
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
