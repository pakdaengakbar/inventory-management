<?php

namespace App\Livewire\Trpurchaseord;
use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as s_;
use App\Constants\Status as p_;

class Formadd extends Component
{
    public $page, $ppn ;
    public $path, $suppliers;
    public $pageTitle, $pageDescription, $pageBreadcrumb;
    public function __construct() {
        $this->page = array(
            'p' => 'purchase/',
            't' => 'Purchase Order',
            'd' => 'Add Data'
        );
    }

    public function mount()
    {
        // Get Data
        $this->ppn = p_::PPN_;
         // get Master
        $this->path      = p_::URL_. $this->page['p'];
        $this->suppliers = s_::getSupplier();
        $this->pageTitle = $t  = $this->page['t'];
        $this->pageDescription = $d = $this->page['d'];
        $this->pageBreadcrumb  = h_::setBreadcrumb($t, $d, strtolower($t));

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
        $uauth = s_::getUser_Auth();
        $code  = s_::MaxNumber('tr_orderhdr', $uauth['region_id'], $uauth['companie_id']);
        $no_po = 'PO-'.date('ymd').'-'.$code['gennum'];
        try {
            return view('livewire.trpurchaseord.formadd', ['no_po' => $no_po]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
