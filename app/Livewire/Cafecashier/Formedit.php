<?php

namespace App\Livewire\Cafecashier;

use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Constants\Status as s_;

use App\Models\tr_saleshdr as soheader;
use App\Models\tr_salesdtl as sodetail;

class Formedit extends Component
{
    public $page, $path, $no=0;
    public $table, $food, $drink, $package;
    public $ppn, $bank, $fee, $fee_on, $pmethod;
    public $pageTitle, $pageDescription, $pageBreadcrumb;
    public $dtheader, $dtdetail;
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
    public function mount($id)
    {
        $this->dtheader = soheader::find($id);
        $this->dtdetail = sodetail::where('nheader_id', $id)->get();

        $this->ppn    = s_::PPN_;
        $this->fee    = s_::FEE_;
        $this->fee_on = s_::FEE_ON;
        $this->path   = s_::URL_. $this->page['p'];

        $this->table  = h_::getTableCafe();
        $this->pmethod= h_::getPaymethod();
        $this->bank   = h_::getBank();
        $this->food   = h_::getItemCafe(array('cgroup_code' => '101'),'id');
        $this->drink  = h_::getItemCafe(array('cgroup_code' => '100'),'id');
        $this->package= h_::getItemCafe(array('cgroup_code' => '102'),'id');
        $this->pageTitle  = $t = $this->page['t'];
        $this->pageDescription = $d = $this->page['d'];
        $this->pageBreadcrumb  = h_::setBreadcrumb($t, $d, 'cashiers/', strtolower($t));
    }
    /**
     * render
     */
    public function render()
    {
        try {
            return view('livewire.cafecashier.formedit');
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}

