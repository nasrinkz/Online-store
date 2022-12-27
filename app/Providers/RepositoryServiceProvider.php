<?php

namespace App\Providers;

use App\Repositories\Auth\IAuthentication;
use App\Repositories\Auth\Authentication;
use App\Repositories\City\Cities;
use App\Repositories\City\ICities;
use App\Repositories\Province\IProvinces;
use App\Repositories\Province\Provinces;
use App\Repositories\UserGroups\IUserGroups;
use App\Repositories\UserGroups\UserGroups;
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
        $this->app->bind(IUserGroups::class,UserGroups::class);
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
