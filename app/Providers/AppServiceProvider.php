<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

                view()->composer('*', function ($view)
                {
                    if (Auth::check()) {
                        view()->share('user_name', Auth::user()->name);
                    } else {
                        return redirect('/');
                    }
                });

            }else{
                die("Could not find the database. Please check your configuration");
            }
        } catch (\Exception $e) {
            die("Could not open connection server.  Please check your configuration...");
        }
    }
}
