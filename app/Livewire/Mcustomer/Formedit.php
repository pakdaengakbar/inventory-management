<?php

namespace App\Livewire\Mcustomer;

use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;

use App\Models\Mcustomer as customer;

class Formedit extends Component
{
    public $page, $id, $ccode, $caddress2, $cphone, $cmobile,
           $cfax, $nlimit_received, $nmax_invoice, $nblock_duedate, $ccity,
           $ccreate_by, $cupdate_by, $ncompanie_id, $cregion_id, $caccount,
           $cstatus, $cemail, $cflag;

    public function __construct() {
        $this->page = array(
            'title' => 'Customers',
            'description'=> 'Update Data'
        );
    }
     //name
    #[Rule('required', message: 'Nama Cabang Harus Diisi')]
    public $cname;

    //address
    #[Rule('required', message: 'Alamat Cabang Harus Diisi')]
    #[Rule('min:3', message: 'Isi Post Minimal 3 Karakter')]
    public $caddress1;

    public function mount($id)
    {
        // Get supplier data
        $data = customer::find($id);
        // Assign values
        $this->id                 = $data->id;
        $this->ccode              = $data->ccode;
        $this->cname              = $data->cname;
        $this->caddress1          = $data->caddress1;
        $this->caddress2          = $data->caddress2;
        $this->cphone             = $data->cphone;
        $this->cmobile            = $data->cmobile;
        $this->cfax               = $data->cfax;
        $this->nlimit_received    = $data->nlimit_received;
        $this->nmax_invoice       = $data->nmax_invoice;
        $this->nblock_duedate     = $data->nblock_duedate;
        $this->ccity              = $data->ccity;
        $this->ncompanie_id       = $data->ncompanie_id;
        $this->cregion_id         = $data->cregion_id;
        $this->caccount           = $data->caccount;
        $this->cstatus            = $data->cstatus;
        $this->cemail             = $data->cemail;

    }

    /**
     * update
     *
     * @return void
     */
    public function update()
    {
        $uauth = v_::getUser_Auth();
        $this->validate();
        //get data
        $data = customer::find($this->id);
        //check if image
        $row = array(
            'ccode'            => $this->ccode,
            'cname'            => $this->cname,
            'caddress1'        => $this->caddress1,
            'caddress2'        => $this->caddress2,
            'cphone'           => $this->cphone,
            'cmobile'          => $this->cmobile,
            'cfax'             => $this->cfax,
            'nlimit_received'  => $this->nlimit_received,
            'nmax_invoice'     => $this->nmax_invoice,
            'nblock_duedate'   => $this->nblock_duedate,
            'ccity'            => $this->ccity,
            'cupdate_by'       => $uauth['id'],
            'ncompanie_id'     => $this->ncompanie_id,
            'cregion_id'       => $this->cregion_id,
            'caccount'         => $this->caccount,
            'cstatus'          => $this->cstatus,
            'cemail'           => $this->cemail,
            'cflag'            => $this->cflag,
        );

        $data->update($row);
        //flash message
        session()->flash('message', 'Update Successfuly.');
        //redirect
        return redirect()->route('customers.index');
    }

    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        try {
            $cities = v_::getCities();
            $company= v_::getCompany();
            $region = v_::getRegion();
            $pageBreadcrumb =  h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.mcustomer.formedit', [
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
                'company'=> $company,
                'region' => $region,
                'cities' => $cities
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }

}
