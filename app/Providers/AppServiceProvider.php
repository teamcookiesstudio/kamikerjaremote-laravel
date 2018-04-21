<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\User;
use App\Models\Profile;
use App\Models\Portofolio;
use App\Observers\UserObserver;
use App\Observers\ProfileObserver;
use App\Observers\PortofolioObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        User::observe(UserObserver::class);
        Profile::observe(ProfileObserver::class);
        Portofolio::observe(PortofolioObserver::class);
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
