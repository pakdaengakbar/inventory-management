<?php

namespace App\Livewire\Trpurchaseord;

use Livewire\Component;
use App\Helpers\MyHelper as h_;

use App\Models\tr_orderhdr as oheader;
use App\Models\tr_orderdtl as odetail;

class Printdata extends Component
{
    public $page, $dtheader, $dtdetail;
    public $no=1;
    public function __construct() {
        $this->page  = array(
            'title' => 'Order',
            'description'=> 'Print',
        );
    }
    public function mount($id)
    {
         // Get Data
        $this->dtheader = oheader::find($id);
        $this->dtdetail = odetail::where('nheader_id', $id)->get();
    }
    public function render()
    {
        try {
            $pageBreadcrumb = h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.trpurchaseord.printdata', [
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
