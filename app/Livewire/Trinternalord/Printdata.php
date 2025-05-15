<?php

namespace App\Livewire\Trinternalord;

use Livewire\Component;
use App\Helpers\MyHelper as h_;

use App\Models\tr_inorderhdr as ioheader;
use App\Models\tr_inorderdtl as iodetail;

class Printdata extends Component
{
    public $page, $dtheader, $dtdetail;

    public function __construct() {
        $this->page  = array(
            'title' => 'Internal',
            'description'=> 'Print',
        );
    }
    public function mount($id)
    {
        // Get Header data
        $this->dtheader = ioheader::find($id);
        // Get Header data
        $this->dtdetail = iodetail::where('nheader_id', $id)->get();
    }
    public function render()
    {
        try {
            $pageBreadcrumb = h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.trinternalord.printdata', [
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
