<?php

namespace App\Livewire\Trquotationord;
use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;

use App\Models\tr_inorderhdr as ioheader;
use App\Models\tr_inorderdtl as iodetail;

class Formedit extends Component
{
    public $page, $dtheader, $dtdetail;

    public function __construct() {
        $this->page = array(
            'title' => 'Quotation Order',
            'description'=> 'Edit Data'
        );
    }

    public function mount($id)
    {
        // Get Header data
        $this->dtheader = ioheader::find($id);
        // Get Header data
        $this->dtdetail = iodetail::where('nheader_id', $id)->get();
    }

    /**
     * store
     */
    public function update()
    {
        // Debugging ntotal value
        //validate
    }
    /**
     * render
     */
    public function render()
    {
        $region = v_::getRegion();
        try {
            $pageBreadcrumb =  h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.trquotationord.formedit', [
                'no' => 1,
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
                'suppliers'=> v_::getSupplier(),
                'region'   => $region,
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
