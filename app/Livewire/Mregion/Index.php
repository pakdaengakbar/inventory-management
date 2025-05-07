<?php
namespace App\Livewire\Mregion;

use Livewire\Component;
use App\Helpers\MyHelper as h_;
use App\Constants\Status as s_;

use App\Models\Mregion as region;

class Index extends Component
{
    public $page;
    public function __construct() {
        $this->page  = array(
            'title'=> 'Profile',
            'description'=> 'Data Branch',
        );
    }

    public function render()
    {
        try {
            $data = region::all();
            $pageBreadcrumb = h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            return view('livewire.mregion.index', [
                'url'            => s_::URL_. 'companies/',
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
        region::destroy($id);
        session()->flash('message', 'Delete Success.');
        return redirect()->route('regions.index');
    }
}


