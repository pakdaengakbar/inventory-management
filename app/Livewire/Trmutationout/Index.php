<?php

namespace App\Livewire\Trmutatuinout;

use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Helpers\MyService as v_;
use App\Constants\Status as s_;

use App\Models\tr_qorderhdr as qoheader;
use App\Models\tr_qorderhdr as qodetail;

class Index extends Component
{
    public $page;
    public function __construct() {
        $this->page  = array(
            'path'  => 'mutationout/',
            'title' => 'Inventory',
            'description'=> 'Mutation Out',
        );
    }

    public function render()
    {
        try {
            $region= v_::getRegion();
            $pageBreadcrumb = h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.trmutatuinout.index', [
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

    public function destroy($id)
    {
        //destroy
        qoheader::destroy($id);
        qodetail::where('nheader_id', $id)->delete();
        $this->dispatch('delDataTable', ['message' => 'Data '.$this->page['description'].' successfully.']);
    }
}
