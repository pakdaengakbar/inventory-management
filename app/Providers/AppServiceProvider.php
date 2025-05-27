<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\mprofile as profile;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            DB::connection()->getPdo();
            if(DB::connection()->getDatabaseName()){

                $url_img = 'storage/';
                view()->share('url_img', $url_img);

                $no_img = 'storage/NoImage.jpg';
                view()->share('no_img', $no_img);

                $app_img = 'storage/app_stamp.png';
                view()->share('app_img', $app_img);

                view()->composer('*', function ($view)
                {
                    if (Auth::check()) {
                        view()->share('user_name', Auth::user()->name);
                    } else {
                        return redirect('/');
                    }
                });

                $profile= profile::where('cstatus',1)->first();
                view()->share('profile', $profile);

            }else{
                die("Could not find the database. Please check your configuration");
            }
        } catch (\Exception $e) {
            die("Could not open connection server.  Please check your configuration...");
        }
    }
}
