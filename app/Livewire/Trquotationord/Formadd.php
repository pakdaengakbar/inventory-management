<?php

namespace App\Livewire\Trquotationord;
use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;

class Formadd extends Component
{
    public $page;

    public function __construct() {
        $this->page = array(
            'title' => 'Quotation Order',
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
        $uauth = v_::getUser_Auth();
        $code  = v_::MaxNumber('tr_qorderhdr', $uauth['region_id'], $uauth['companie_id']);
        $no_inorder = 'QO-'.date('ymd').'-'.$code['gennum'];
        try {
            $pageBreadcrumb =  h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.trquotationord.formadd', [
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
