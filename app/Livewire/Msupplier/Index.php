<?php

namespace App\Livewire\Msupplier;

use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Models\msupplier as supplier;

class Index extends Component
{
    public $page;
    public function __construct() {
        $this->page  = array(
            'title' => 'Master',
            'description'=> 'Data Supplier',
        );
    }

    public function render()
    {
        $data = supplier::all();
        try {
            $pageBreadcrumb = h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.msupplier.index', [
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
                'data' => $data,
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }

    public function destroy($id)
    {
        //destroy
        supplier::destroy($id);
        session()->flash('message', 'Delete Success.');
        return redirect()->route('suppliers.index');
    }
}
