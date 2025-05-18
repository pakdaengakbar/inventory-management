<?php

namespace App\Livewire\Trmutationout;
use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as s_;

class Formadd extends Component
{
    public $page;
    public $expedition, $region, $employee;
    public $pageTitle, $pageDescription, $pageBreadcrumb;

    public function __construct() {
        $this->page = array(
            't' => 'Mutation Out',
            'd'=> 'Add Data '
        );
    }
    /**
     * mounts
     */
    public function mount()
    {
        $this->region    = s_::getRegion();
        $this->expedition= s_::getExped(1);
        $this->employee  = s_::getEmployee('Actived');
        $this->pageTitle  = $t = $this->page['t'];
        $this->pageDescription = $d = $this->page['d'];
        $this->pageBreadcrumb  = h_::setBreadcrumb($t, $d, strtolower($t));

    }
    /**
     * render
     */
    public function render()
    {
        $uauth = s_::getUser_Auth();
        $code  = s_::MaxNumber('tr_mutationhdr', $uauth['region_id'], $uauth['companie_id']);
        $nomut = 'MOT-'.date('ymd').'-'.$code['gennum'];
        try {
            return view('livewire.trmutationout.formadd', ['no_mutation'=> $nomut]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
