<?php

namespace App\Livewire\Trmutationout;

use Livewire\Component;
use App\Helpers\MyHelper as h_;

use App\Models\tr_mutationhdr as moheader;
use App\Models\tr_mutationdtl as modetail;

class Printdata extends Component
{
    public $no=1;
    public $page, $dtheader, $dtdetail;
    public $pageTitle, $pageDescription, $pageBreadcrumb;
    public function __construct() {
        $this->page  = array(
            't' => 'Mutation Out',
            'd'=> 'Print',
        );
    }
    public function mount($id)
    {
         // Get Data
        $this->dtheader = moheader::find($id);
        $this->dtdetail = modetail::where('nheader_id', $id)->get();
        $this->pageTitle = $t  = $this->page['t'];
        $this->pageDescription = $d = $this->page['d'];
        $this->pageBreadcrumb  = h_::setBreadcrumb($t, $d, strtolower($t));
    }
    public function render()
    {
        try {
            return view('livewire.trmutationout.printdata');
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
