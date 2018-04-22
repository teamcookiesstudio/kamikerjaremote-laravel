<?php

namespace App\Providers;

use App\Models\Portofolio;
use App\Models\Profile;
use App\Observers\PortofolioObserver;
use App\Observers\ProfileObserver;
use App\Observers\UserObserver;
use App\User;
use Illuminate\Support\Facades\Schema;
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
