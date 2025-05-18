<?php

namespace App\Livewire\Trmutationout;
use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;

use App\Models\tr_mutationhdr as moheader;
use App\Models\tr_mutationdtl as modetail;

class Formedit extends Component
{
    public $page, $dtheader, $dtdetail;
    public $expedition, $region;
    public function __construct() {
        $this->page = array(
            'title' => 'Mutation Out',
            'description'=> 'Edit Data'
        );
    }

    public function mount($id)
    {
        // Get Data
        $this->dtheader = moheader::find($id);
        $this->dtdetail = modetail::where('nheader_id', $id)->get();
        // Get master
        $this->region = v_::getRegion();
        $this->expedition = v_::getAllDataLimited('mexpeditions','id',10);
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
            return view('livewire.trmutationout.formedit', [
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
