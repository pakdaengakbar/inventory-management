<?php

namespace App\Livewire\Trquotationord;

use Livewire\Component;
use App\Helpers\MyHelper as h_;

use App\Models\tr_qorderhdr as qoheader;
use App\Models\tr_qorderdtl as qodetail;

class Printdata extends Component
{
    public $page, $dtheader, $dtdetail;
    public $no=1;
    public function __construct() {
        $this->page  = array(
            'title' => 'Quotation',
            'description'=> 'Print',
        );
    }
    public function mount($id)
    {
         // Get Data
        $this->dtheader = qoheader::find($id);
        $this->dtdetail = qodetail::where('nheader_id', $id)->get();
    }
    public function render()
    {
        try {
            $pageBreadcrumb = h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.trquotationord.printdata', [
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
