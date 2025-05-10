<?php

namespace App\Livewire\Mproduct;

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
            'path'  => 'product/',
            'title' => 'Master',
            'description'=> 'Data Product',
        );
    }

    public function render()
    {
        $data = product::all();
        try {
            $group= v_::getProdgroup();
            $pageBreadcrumb = h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.mproduct.index', [
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
        session()->flash('message', 'Delete Success.');
        return redirect()->route('product.index');
    }
}
