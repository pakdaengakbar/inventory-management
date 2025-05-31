<?php

namespace App\Livewire\Cafecashier;

use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as s_;
use App\Constants\Status as p_;

class Formadd extends Component
{
    public $page, $path, $no=0;
    public $table, $food, $drink, $package;
    public $ppn, $bank, $fee, $fee_on, $pmethod;
    public $pageTitle, $pageDescription, $pageBreadcrumb;
    public function __construct() {
        $this->page = array(
            'p' => 'cashiers/',
            't' => 'Cashier',
            'd' => 'Add Data '
        );
    }
    /**
     * mounts
     */
    public function mount()
    {
        $this->ppn      = p_::PPN_;
        $this->fee      = p_::FEE_;
        $this->fee_on   = p_::FEE_ON;
        $this->path     = p_::URL_. $this->page['p'];

        $this->table    = h_::getTableCafe();
        $this->food     = h_::getItemCafe(array('cgroup_code' => '101'),'id');
        $this->drink    = h_::getItemCafe(array('cgroup_code' => '100'),'id');
        $this->package  = h_::getItemCafe(array('cgroup_code' => '102'),'id');
        $this->pageTitle= $t = $this->page['t'];
        $this->pageDescription = $d = $this->page['d'];
        $this->pageBreadcrumb  = h_::setBreadcrumb($t, $d, 'cashiers/', strtolower($t));
    }
    /**
     * render
     */
    public function render()
    {
        $uauth = s_::getUser_Auth();
        $code  = s_::MaxNumber('tr_saleshdr', $uauth['region_id'], $uauth['companie_id']);
        $noso  = 'CF-'.date('ymd').'-'.$code['gennum'];
        try {
            return view('livewire.cafecashier.formadd', ['cno_faktur'=> $noso]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}

