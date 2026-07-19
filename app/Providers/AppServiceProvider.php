<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View; // Required for the alert bar
use Illuminate\Support\Facades\DB;   // Required for the alert bar

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFour();

        // This makes the $alert variable available in all views
        View::composer('*', function ($view) {
            $alert = DB::table('alerts')->where('active', 1)->first();
            $view->with('siteAlert', $alert);
        });
    }
}
