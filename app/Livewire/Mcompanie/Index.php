<?php

namespace App\Livewire\Mcompanie;

use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Constants\Status as s_;
use App\Models\Mcompanie as companie;

class Index extends Component
{
    public $page;
    public $pageTitle, $pageDescription, $pageBreadcrumb, $cities;
    public function __construct() {
        $this->page  = array(
            'p'  => 'companies/',
            't' => 'Companies',
            'd'=> 'Data Companies',
        );
    }
    public function mount()
    {
        $this->pageBreadcrumb = h_::setBreadcrumb($t = $this->page['t'], $d = $this->page['d'], 'profile/', strtolower($t));
        $this->pageTitle = $t;
        $this->pageDescription = $d;
    }
    public function render()
    {
        $data = companie::all();
        try {
            return view('livewire.mcompanie.index', [
                'data' => $data,
                'path' => s_::URL_. $this->page['p'],
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }

    public function destroy($id)
    {
        //destroy
        companie::destroy($id);
        //flash message
        session()->flash('message', 'Delete Success.');
        //redirect
        return redirect()->route('companies.index');
    }
}
