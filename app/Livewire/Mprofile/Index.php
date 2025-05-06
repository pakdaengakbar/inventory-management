<?php
namespace App\Livewire\mprofile;
use Illuminate\Support\Facades\Storage;

use App\Models\Mprofile as profile;
use App\Models\indcities as cities;
use Livewire\WithFileUploads;
use Livewire\Component;
use Livewire\Attributes\validate;

use App\Constants\Status as s_;
use App\Helpers\MyService as v_;
use App\Helpers\MyHelper as h_;

class Index extends Component
{
    use WithFileUploads;
    public $page, $photo, $image;
    public $id, $cnama, $cstatus, $ccity, $cphone, $cfax, $cemail, $clogo, $ctitle, $ccreate_by, $cupdate_by,
           $cimage, $cmotto, $updatePost = false, $addPost = false;

    #[validate('required', message: 'Application Name Required')]
    public $cname;

    #[validate('required', message: 'Application Description Required')]
    public $caddress;

     //image
    //  #[validate('required', message: 'Masukkan Gambar Logo')]
    //  #[validate('image', message: 'File Harus Gambar')]
    //  #[validate('max:1024', message: 'Ukuran File Maksimal 1MB')]
    //  public $image;

    public function __construct() {
        $this->page = array(
            'title' => 'Profile',
            'description'=> 'Aplication Profile',
        );
    }

    public function mount()
    {
        //get post
        $data = profile::where('cstatus',1)->first();
        $this->id      = $data->id;
        $this->cname   = $data->cname;
        $this->cmotto  = $data->cmotto;
        $this->caddress= $data->caddress;
        $this->ccity   = $data->ccity;
        $this->cphone  = $data->cphone;
        $this->cfax    = $data->cfax;
        $this->cemail  = $data->cemail;
        $this->photo   = $data->clogo;
        $this->ctitle  = $data->ctitle;
        $this->ccreate_by= $data->ccreate_by;
        $this->cupdate_by= $data->cupdate_by;
        $this->cstatus = $data->cstatus;
    }

    public function render()
    {
        try {
            $pageBreadcrumb =  h_::setBreadcrumb($title = $this->page['title'], $descr = $this->page['description'], strtolower($title));
            $cities = cities::all();
            return view('livewire.mprofile.index', [
                'url'            => s_::URL_. 'profile/',
                'cities'         => $cities,
                'pageTitle'      => $title,
                'pageDescription'=> $descr,
                'pageBreadcrumb' => $pageBreadcrumb
            ]);
        }catch(\Exception $e)
        {
            return view('livewire.error404.index');
        }
    }
    /**
     * delete action listener
     */
    protected $listeners = [
        'deletePostListner'=>'deletePost'
    ];
    /**
     * List of add/edit form rules
     */
    protected $rules = [
        'id'   => 'required',
        // 'cname' => 'required',
        // 'cmotto'=> 'required',
    ];
    /**
     * Cancel Add/Edit form and redirect to post listing page
     * @return void
     */
    public function cancel()
    {
        $this->addPost = false;
        $this->updatePost = false;
        $this->resetFields();
    }

    public function update()
    {
        $this->validate();
        $p_ = s_::PATH_. 'profile/';
        $uauth = v_::getUser_Auth();

        try {
            $setting = profile::find($this->id);
            $row = array(
            'cname'     => $this->cname,
            'cmotto'    => $this->cmotto,
            'caddress'  => $this->caddress,
            'ccity'     => $this->ccity,
            'cphone'    => $this->cphone,
            'cemail'    => $this->cemail,
            'cfax'      => $this->cfax,
            'ctitle'    => $this->ctitle,
            'cupdate_by'=> $uauth['id'],
            'cstatus'   => $this->cstatus,
            );

            if ($this->image) {
            $p_ = s_::PATH_. 'profile/';
            Storage::delete($p_.$this->photo);
            $this->image->storeAs($p_, $this->image->hashName());
            $row['clogo'] = $this->image->hashName();
            }
            $setting->update($row);

            session()->flash('message', 'Profile Updated Successfully!!');
            return redirect()->route('profile.index');

        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    /**
     * delete specific post data from the posts table
     * @param mixed $id
     * @return void
     */
    public function destroy($id)
    {
        try {
            profile::find($id)->delete();
            session()->flash('message', "Profile Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
}
