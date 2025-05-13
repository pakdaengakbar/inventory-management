<?php

namespace App\Livewire\Trinternalord;
use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;

use App\Models\tr_inorderhdr as ioheader;
use App\Models\tr_inorderdtl as iodetail;

class Formadd extends Component
{
    public $page;

    public function __construct() {
        $this->page = array(
            'title' => 'Internal Order',
            'description'=> 'Add Data'
        );
    }
    /**
     * store
     */
    public function store()
    {
        // Debugging ntotal value
        //validate
    }
    /**
     * render
     */
    public function render()
    {
        $code = v_::MaxNumber('tr_inorderhdr', 1, 1);
        $no_inorder = 'IO-'.date('ymd').'-'.$code;
        try {
            $pageBreadcrumb =  h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.trinternalord.formadd', [
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
                'no_inorder' => $no_inorder,
                'suppliers'  => v_::getSupplier(),
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
