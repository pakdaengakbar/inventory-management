<?php

namespace App\Livewire\Mcustomer;

use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Models\memployee as employee;

class Index extends Component
{
    public $page;
    public function __construct() {
        $this->page  = array(
            'title' => 'Master',
            'description'=> 'Data Employee',
        );
    }

    public function render()
    {
        $data = employee::all();
        try {
            $pageBreadcrumb = h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.mcustomer.index', [
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
        employee::destroy($id);
        session()->flash('message', 'Delete Success.');
        return redirect()->route('companies.index');
    }
}
