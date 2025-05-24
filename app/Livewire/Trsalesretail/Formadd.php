<?php

namespace App\Livewire\Trsalesretail;

use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as s_;
use App\Constants\Status as p_;

class Formadd extends Component
{
    public $page, $path, $ppn;
    public $pageTitle, $pageDescription, $pageBreadcrumb;
    public function __construct() {
        $this->page = array(
            'p' => 'retail/',
            't' => 'Retail',
            'd' => 'Add Data '
        );
    }
    /**
     * mounts
     */
    public function mount()
    {
        $this->ppn     = p_::PPN_;
        $this->path    = p_::URL_. $this->page['p'];
        $this->pageTitle  = $t = $this->page['t'];
        $this->pageDescription = $d = $this->page['d'];
        $this->pageBreadcrumb  = h_::setBreadcrumb($t, $d, 'sales/', strtolower($t));
    }
    /**
     * render
     */
    public function render()
    {
        $uauth = s_::getUser_Auth();
        $code  = s_::MaxNumber('tr_saleshdr', $uauth['region_id'], $uauth['companie_id']);
        $noso  = 'SO-'.date('ymd').'-'.$code['gennum'];
        try {
            return view('livewire.Trsalesretail.formadd', ['cno_faktur'=> $noso]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}

