<?php

namespace App\Livewire\Trmutationout;

use Livewire\Component;
use App\Helpers\MyHelper as h_;

use App\Models\tr_mutationhdr as moheader;
use App\Models\tr_mutationdtl as modetail;

class Printdata extends Component
{
    public $page, $dtheader, $dtdetail;
    public $no=1;
    public function __construct() {
        $this->page  = array(
            'title' => 'Mutation Out',
            'description'=> 'Print',
        );
    }
    public function mount($id)
    {
        // Get Header data
        $this->dtheader = moheader::find($id);
        // Get Header data
        $this->dtdetail = modetail::where('nheader_id', $id)->get();
    }
    public function render()
    {
        try {
            $pageBreadcrumb = h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.trmutationout.printdata', [
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
