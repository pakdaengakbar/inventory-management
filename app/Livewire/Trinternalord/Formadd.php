<?php

namespace App\Livewire\Trinternalord;
use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;

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
        // validate
    }
    /**
     * render
     */
    public function render()
    {
        $uauth = v_::getUser_Auth();
        $code  = v_::MaxNumber('tr_inorderhdr', $uauth['region_id'], $uauth['companie_id']);
        $no_inorder = 'IO-'.date('ymd').'-'.$code['gennum'];
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
