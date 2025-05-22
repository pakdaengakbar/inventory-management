<?php

namespace App\Livewire\Trinternalord;
use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;

class Formadd extends Component
{
    public $page, $region, $suppliers;
    public $pageTitle, $pageDescription, $pageBreadcrumb;
    public function __construct() {
        $this->page = array(
            't' => 'Internal Order',
            'd' => 'Add Data'
        );
    }
   /**
     * mounts
     */
    public function mount()
    {
        $this->region     = v_::getRegion();
        $this->suppliers  = v_::getSupplier();

        $this->pageTitle  = $t = $this->page['t'];
        $this->pageDescription = $d = $this->page['d'];
        $this->pageBreadcrumb  = h_::setBreadcrumb($t, $d, 'inventory/', 'intorder');
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
            return view('livewire.trinternalord.formadd', ['no_inorder' => $no_inorder]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
