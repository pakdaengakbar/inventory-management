<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MyFormatProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
         require_once app_path().'/Helpers/MyFormat.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
