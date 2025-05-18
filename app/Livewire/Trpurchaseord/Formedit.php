<?php

namespace App\Livewire\Trpurchaseord;
use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;

use App\Models\tr_orderhdr as oheader;
use App\Models\tr_orderdtl as odetail;

class Formedit extends Component
{
    public $page, $dtheader, $dtdetail;
    public $region;
    public function __construct() {
        $this->page = array(
            'title' => 'Purchase Order',
            'description'=> 'Edit Data'
        );
    }

    public function mount($id)
    {
        // Get Data
        $this->dtheader = oheader::find($id);
        $this->dtdetail = odetail::where('nheader_id', $id)->get();
         // get Master
        $this->region = v_::getRegion();
    }

    /**
     * store
     */
    public function update()
    {
        // Debugging
        //validate
    }
    /**
     * render
     */
    public function render()
    {
        try {
            $pageBreadcrumb =  h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.trpurchaseord.formedit', [
                'no' => 1,
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
                'suppliers'=> v_::getSupplier(),
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
