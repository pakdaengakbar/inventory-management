<?php

namespace App\Livewire\Trinternalord;

use Livewire\Component;
use App\Helpers\MyHelper as h_;

use App\Models\tr_inorderhdr as ioheader;
use App\Models\tr_inorderdtl as iodetail;

class Printdata extends Component
{
    public $page, $no=1, $dtheader, $dtdetail;
    public $pageTitle, $pageDescription, $pageBreadcrumb;
    public function __construct() {
        $this->page  = array(
            't' => 'Internal',
            'd' => 'Print',
        );
    }
    public function mount($id)
    {
        // Get Data
        $this->dtheader = ioheader::find($id);
        $this->dtdetail = iodetail::where('nheader_id', $id)->get();

        $this->pageTitle  = $t = $this->page['t'];
        $this->pageDescription = $d = $this->page['d'];
        $this->pageBreadcrumb  = h_::setBreadcrumb($t, $d, 'inventory/', 'intorder');
    }
    public function render()
    {
        try {
            return view('livewire.trinternalord.printdata');
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
