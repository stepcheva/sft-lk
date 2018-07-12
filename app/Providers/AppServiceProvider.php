<?php

namespace App\Providers;

use App\Models\Application;
use App\Models\User;
use App\Observers\UsersObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UsersObserver::class);
        Application::observe(ApplicationObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
