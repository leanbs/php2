<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        require base_path() . '/resources/macros/checkbox.php';
        require base_path() . '/resources/macros/radiobutton.php';
        //require base_path() . '/resources/macros/label.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
