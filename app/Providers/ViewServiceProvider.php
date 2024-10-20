<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('profile');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}