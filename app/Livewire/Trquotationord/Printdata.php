<?php

namespace App\Livewire\Trquotationord;

use Livewire\Component;
use App\Helpers\MyHelper as h_;

use App\Models\tr_qorderhdr as qoheader;
use App\Models\tr_qorderdtl as qodetail;

class Printdata extends Component
{
    public $page, $no=1, $dtheader, $dtdetail;
    public $pageTitle, $pageDescription, $pageBreadcrumb;
    public function __construct() {
        $this->page  = array(
            't' => 'Quotation',
            'd' => 'Print',
        );
    }
    public function mount($id)
    {
         // Get Data
        $this->dtheader = qoheader::find($id);
        $this->dtdetail = qodetail::where('nheader_id', $id)->get();

        $this->pageTitle  = $t = $this->page['t'];
        $this->pageDescription = $d = $this->page['d'];
        $this->pageBreadcrumb  = h_::setBreadcrumb($t, $d, 'inventory/', 'quorder');
    }
    public function render()
    {
        try {
           return view('livewire.trquotationord.printdata');
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
