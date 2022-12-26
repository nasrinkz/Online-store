<?php

namespace App\Providers;

use App\Repositories\Auth\IAuthentication;
use App\Repositories\Auth\Authentication;
use App\Repositories\City\Cities;
use App\Repositories\City\ICities;
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
        $this->app->bind(ICities::class,Cities::class);
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
