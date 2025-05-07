<?php

namespace App\Livewire\Mdepart;

use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Constants\Status as s_;
use App\Models\Mdepart as departs;
use App\Models\Mposition as positions;

class Index extends Component
{
    public $page;
    public function __construct() {
        $this->page  = array(
            'title' => 'Master',
            'description'=> 'Data Departs',
        );
    }

    public function render()
    {
        $departs = departs::all();
        $positions = positions::all();
        try {
            $pageBreadcrumb = h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.mdepart.index', [
                'path'           => s_::URL_. 'companies/',
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb,
                'departs'  => $departs,
                'positions'=> $positions,
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }

    }

}
