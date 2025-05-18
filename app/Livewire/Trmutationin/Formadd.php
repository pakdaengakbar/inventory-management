<?php

namespace App\Livewire\Trmutationin;
use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;

class Formadd extends Component
{
    public $page;

    public function __construct() {
        $this->page = array(
            'title' => 'Mutation In',
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
        $code  = v_::MaxNumber('tr_mutationhdr', $uauth['region_id'], $uauth['companie_id']);
        $nomut = 'MIN-'.date('ymd').'-'.$code['gennum'];
        try {
            $pageBreadcrumb =  h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.Trmutationin.formadd', [
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
                'no_mutation' => $nomut,
                'suppliers'  => v_::getSupplier(),
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
