<?php

namespace App\Livewire\Mcompanie;

use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Constants\Status as s_;
use App\Models\Mcompanie as companie;

class Index extends Component
{
    public $page;
    public function __construct() {
        $this->page  = array(
            'title' => 'Profile',
            'description'=> 'Data Companies',
        );
    }

    public function render()
    {
        $data = companie::all();
        try {
            $pageBreadcrumb = h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.mcompanie.index', [
                'path'           => s_::URL_. 'companies/',
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
        companie::destroy($id);
        //flash message
        session()->flash('message', 'Delete Success.');
        //redirect
        return redirect()->route('companies.index');
    }
}
