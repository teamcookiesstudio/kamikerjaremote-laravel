<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\ProfileRepository::class, \App\Repositories\ProfileRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PortofolioRepository::class, \App\Repositories\PortofolioRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SkillSetRepository::class, \App\Repositories\SkillSetRepositoryEloquent::class);
        //:end-bindings:
    }
}
