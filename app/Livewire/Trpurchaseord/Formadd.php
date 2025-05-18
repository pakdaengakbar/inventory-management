<?php

namespace App\Livewire\Trpurchaseord;
use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;
use App\Constants\Status as s_;

class Formadd extends Component
{
    public $page, $ppn;
    public $suppliers;
    public function __construct() {
        $this->page = array(
            'title' => 'Purchase Order',
            'description'=> 'Add Data'
        );
    }

    public function mount()
    {
        // Get Data
        $this->ppn = s_::PPN_;
         // get Master
        $this->suppliers = v_::getSupplier();
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
        $code  = v_::MaxNumber('tr_orderhdr', $uauth['region_id'], $uauth['companie_id']);
        $no_po = 'PO-'.date('ymd').'-'.$code['gennum'];
        try {
            $pageBreadcrumb =  h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.trpurchaseord.formadd', [
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
                'no_po'     => $no_po,
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
