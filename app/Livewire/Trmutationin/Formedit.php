<?php

namespace App\Livewire\Trmutationin;
use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;

use App\Models\tr_orderhdr as oheader;
use App\Models\tr_orderdtl as odetail;

class Formedit extends Component
{
    public $page, $dtheader, $dtdetail;

    public function __construct() {
        $this->page = array(
            'title' => 'Mutation Out',
            'description'=> 'Edit Data'
        );
    }

    public function mount($id)
    {
        // Get Header data
        $this->dtheader = oheader::find($id);
        // Get Header data
        $this->dtdetail = odetail::where('nheader_id', $id)->get();
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
            return view('livewire.Trmutationin.formedit', [
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
