<?php

namespace App\Livewire\Trinternalord;
use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;

use App\Models\tr_inorderhdr as ioheader;
use App\Models\tr_inorderdtl as iodetail;

class Formedit extends Component
{
    public $page,$id, $dtrans_date, $csupplier_id, $cno_inorder, $cstatus, $cnotes, $ntotal, $dtdetail;

    public function __construct() {
        $this->page = array(
            'title' => 'Internal Order',
            'description'=> 'Edit Data'
        );
    }

    public function mount($id)
    {
        // Get Header data
        $dtheader = ioheader::find($id);
        // Assign values
        $this->dtrans_date   = $dtheader->dtrans_date;
        $this->csupplier_id  = $dtheader->csupplier_id;
        $this->cno_inorder   = $dtheader->cno_inorder;
        $this->cnotes   = $dtheader->cnotes;
        $this->cstatus  = $dtheader->cstatus;
        $this->ntotal   = $dtheader->ntotal;
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
        $uauth = v_::getUser_Auth();
        $code  = v_::MaxNumber('tr_inorderhdr', 1, $uauth['companie_id']);
        $no_inorder = 'IO-'.date('ymd').'-'.$code['gennum'];
        try {
            $pageBreadcrumb =  h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.trinternalord.formedit', [
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
                'no_inorder' => $no_inorder,
                'suppliers'  => v_::getSupplier(),
                'no' => 1
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
