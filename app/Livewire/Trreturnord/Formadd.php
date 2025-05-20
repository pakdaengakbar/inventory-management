<?php

namespace App\Livewire\Trdeliveryord;
use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as s_;
use App\Constants\Status as p_;

class Formadd extends Component
{
    public $page, $path;
    public $region, $expedition, $employee;
    public $pageTitle, $pageDescription, $pageBreadcrumb;
    public function __construct() {
        $this->page = array(
            'p' => 'return/',
            't' => 'Return',
            'd' => 'Add Data '
        );
    }
    /**
     * mounts
     */
    public function mount()
    {
        $this->path       = p_::URL_. $this->page['p'];
        $this->region     = s_::getRegion();
        $this->expedition = s_::getExped(1);
        $this->employee   = s_::getEmployee('Actived');
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
        $code  = s_::MaxNumber('tr_dorderhdr', $uauth['region_id'], $uauth['companie_id']);
        $nodo = 'RN-'.date('ymd').'-'.$code['gennum'];
        try {
            return view('livewire.trreturnord.formadd', ['cno_delivery'=> $nodo]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}

