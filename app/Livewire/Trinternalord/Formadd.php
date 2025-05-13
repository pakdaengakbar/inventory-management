<?php

namespace App\Livewire\Trinternalord;

use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;

use App\Models\tr_inorderhdr as ioheader;
use App\Models\tr_inorderdtl as iodetail;

class Formadd extends Component
{
    public $page, $cstatus = 'O';
    public $code, $cregion_id;
    //public $icode = [];
    public $dtrans_date;
    public $ntotal = 0;


    public function __construct() {
        $this->page = array(
            'title' => 'Internal Order',
            'description'=> 'Add Data'
        );
        $this->dtrans_date = now()->format('Y-m-d');
    }

    //supplier
    #[Rule('required', message: 'Nama perusahaan Harus Dipilih')]
    public $csupplier_id;

    //address
    #[Rule('required', message: 'Keterangan Pesanan Harus Diisi')]
    #[Rule('min:3', message: 'Isi Post Minimal 3 Karakter')]
    public $cnotes;

    /**
     * store
     */
    public function store()
    {
        //validate
        $this->validate();
        //check if supplier already exist
        $uauth = v_::getUser_Auth();

        $month = date('m').date('Y');
        $supplier = v_::getRowData('msuppliers', $this->csupplier_id);
        //create post
        $code = v_::MaxNumber('tr_inorderhdr', 1, 1);

        $code = 'IO-'.date('ymd').'-'.$code;
        $data = array(
            'cno_inorder' => $code,
            'dtrans_date' => $this->dtrans_date,
            'csupplier_id'=> $this->csupplier_id,
            'csupplier_name' => $supplier->cname,
            'cnotes'    => $this->cnotes,
            'cstatus'   => 'O',
            'ccashier'  => $uauth['name'],
            'ccreate_by'=> $uauth['id'],
            'cmonth'    => $month,
            'ntotal'    => $this->ntotal ?? 0,
            'cregion_id'=> $this->cregion_id,
            'ncompanie_id' => $uauth['companie_id'],
        );

        ioheader::create($data);
        //flash message
        session()->flash('message', 'Save Successfuly');
        //redirect
        return redirect()->route('intorder.index');
    }

    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        $code = v_::MaxNumber('tr_inorderhdr', 1, 1);
        $no_inorder = 'IO-'.date('ymd').'-'.$code;
        try {
            $pageBreadcrumb =  h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.trinternalord.formadd', [
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
                'no_inorder' => $no_inorder,
                'cstatus'    => $this->cstatus,
                'suppliers'  => v_::getSupplier(),
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
