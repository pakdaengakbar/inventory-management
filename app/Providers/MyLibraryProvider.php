<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MyLibraryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
         require_once app_path().'/Helpers/MyLibrary.php';
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
