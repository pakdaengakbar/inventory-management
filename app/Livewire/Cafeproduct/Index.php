<?php

namespace App\Livewire\Cafeproduct;

use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;
use App\Constants\Status as s_;
use App\Models\mproduct as product;

class Index extends Component
{
    public $page, $path, $group;
    public $pageTitle, $pageDescription, $pageBreadcrumb;

    public function __construct() {
        $this->page  = array(
            'p' => 'product/',
            't' => 'Master',
            'd' => 'Data Product',
        );
    }

    public function mount()
    {
        // get Master
        $this->path      = s_::URL_. $this->page['p'];
        $this->group    =  v_::getProdgroup();
        $this->pageTitle = $t  = $this->page['t'];
        $this->pageDescription = $d = $this->page['d'];
        $this->pageBreadcrumb  = h_::setBreadcrumb($t, $d, strtolower($t));
    }

    public function render()
    {
        try {
            return view('livewire.cafeproduct.index');
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }

    public function destroy($id)
    {
        //destroy
        product::destroy($id);
        $this->dispatch('delDataTable');
        session()->flash('message', 'Delete Data Successfuly..');
    }
}
