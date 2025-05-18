<?php

namespace App\Livewire\Trmutationout;
use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;

class Formadd extends Component
{
    public $page;
    public $expedition, $region;
    public $pageTitle, $pageDescription, $pageBreadcrumb;

    public function __construct() {
        $this->page = array(
            't' => 'Mutation Out',
            'd'=> 'Add Data'
        );
    }
    /**
     * mount
     */
    public function mount()
    {
        $this->region     = v_::getRegion();
        $this->expedition = v_::getExped(1);
        $this->pageBreadcrumb = h_::setBreadcrumb($t = $this->page['t'], $d = $this->page['d'], strtolower($t));
        $this->pageTitle  = $t;
        $this->pageDescription = $d;
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
            return view('livewire.trmutationout.formadd', ['no_mutation'=> $nomut]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
