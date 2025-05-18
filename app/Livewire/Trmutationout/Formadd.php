<?php

namespace App\Livewire\Trmutationout;
use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;

class Formadd extends Component
{
    public $page;

    public function __construct() {
        $this->page = array(
            'title' => 'Mutation Out',
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
        $nomut = 'MOT-'.date('ymd').'-'.$code['gennum'];
        try {
            $pageBreadcrumb =  h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.trmutationout.formadd', [
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
                'no_mutation'=> $nomut,
                'suppliers'  => v_::getSupplier(),
                'expedition' => v_::getAllDataLimited('mexpedition','id',10)
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
