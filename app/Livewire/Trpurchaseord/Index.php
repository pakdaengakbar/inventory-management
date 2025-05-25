<?php

namespace App\Livewire\Trpurchaseord;

use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;
use App\Constants\Status as s_;

use App\Models\tr_orderhdr as oheader;
use App\Models\tr_orderdtl as odetail;

class Index extends Component
{
    public $page;
    public function __construct() {
        $this->page  = array(
            'path'  => 'purchase/',
            'title' => 'Inventory',
            'description'=> 'Purchase Order',
        );
    }

    public function render()
    {
        try {
            $region= v_::getRegion();
            $pageBreadcrumb = h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.trpurchaseord.index', [
                'path'           => s_::URL_. $this->page['path'],
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
                'region'=> $region,
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }

    public function destroy($id, $status)
    {
        //destroy
        if ($status == 'O'){
           oheader::destroy($id);
            odetail::where('nheader_id', $id)->delete();
            $this->dispatch('delDataTable', ['message' => 'Delete Data Successfuly..']);
        }else{
            $this->dispatch('delDataTable', ['message' => 'Error, Data Status Close / Progress']);
        }
    }

}
