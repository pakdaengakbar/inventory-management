<?php

namespace App\Livewire\Cafewaiters;

use Livewire\Component;
use App\Helpers\MyHelper as h_;

use App\Models\tr_saleshdr as soheader;
use App\Models\tr_salesdtl as sodetail;

class Printdata extends Component
{
    public $no=1, $pageTitle, $pageDescription ;
    public $page, $dtheader, $dtdetail;
    public $status;

    public function __construct() {
        $this->page  = array(
            't' => 'Retail',
            'd' => 'Print',
        );
    }
    public function mount($id)
    {
        // Get Header data
        $this->dtheader = soheader::find($id);
        $this->dtdetail = sodetail::select('nbarcode', 'citem_code', 'citem_name', 'nqty' , 'nprice' ,'ntotal')
                                   ->where('nheader_id', $id)->get();
        $this->status = $this->dtheader->cstatus;
        $this->pageTitle = $t  = $this->page['t'];
        $this->pageDescription = $d = $this->page['d'];
    }

    public function printReceipt()
    {
        // Cetak dengan JavaScript
        $this->dispatchBrowserEvent('print-receipt');
        //Cetak dengan Printer Thermal
        try {
            $connector = new FilePrintConnector("/dev/usb/lp0"); // Sesuaikan dengan perangkat printer
            $printer   = new Printer($connector);

            $printer->text("===== My Shop =====\n");
            $printer->text("Tanggal: " . now() . "\n");
            $printer->text("-------------------\n");

            foreach ($this->items as $item) {
                $printer->text("{$item->name}   {$item->qty}   {$item->price}   {$item->total}\n");
            }

            $printer->text("-------------------\n");
            $printer->text("Total: " . $this->total . "\n");
            $printer->text("===================\n");
            $printer->text("Terima Kasih!\n");
            $printer->cut();
            $printer->close();
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal mencetak: ' . $e->getMessage());
        }
    }

    public function render()
    {
        try {
            return view('livewire.cafecashier.printdata');
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
}
