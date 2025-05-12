<?php

namespace App\Livewire\Trinternalord;

use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;
use App\Constants\Status as s_;
use App\Models\mproduct as product;

class Index extends Component
{
    public $page;
    public function __construct() {
        $this->page  = array(
            'path'  => 'intorder/',
            'title' => 'Inventory',
            'description'=> 'Internal Order',
        );
    }

    public function render()
    {
        try {
            $group= v_::getProdgroup();
            $pageBreadcrumb = h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.trinternalord.index', [
                'path'           => s_::URL_. $this->page['path'],
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
                'group'=> $group,
            ]);
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
        session()->flash('message', 'Delete Successfuly.');
    }
}
