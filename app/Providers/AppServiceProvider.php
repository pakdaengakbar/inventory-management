<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

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
        $url_img = 'storage/';
        view()->share('url_img', $url_img);

        //;
        view()->composer('*', function ($view)
        {
            if (Auth::check()) {
                view()->share('user_name', Auth::user()->name);
            } else {
                return redirect('/');
            }
        });
    }
}
