<?php

namespace App\Providers;

use App\Repositories\Auth\IAuthentication;
use App\Repositories\Auth\Authentication;
use App\Repositories\Province\IProvinces;
use App\Repositories\Province\Provinces;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IAuthentication::class,Authentication::class);
        $this->app->bind(IProvinces::class,Provinces::class);
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
