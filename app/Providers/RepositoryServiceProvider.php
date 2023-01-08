<?php

namespace App\Providers;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthenticationController;
use App\Repositories\Brand\Brands;
use App\Repositories\Brand\IBrands;
use App\Repositories\Category\Categories;
use App\Repositories\Category\ICategories;
use App\Repositories\ContactUs\ContactUs;
use App\Repositories\ContactUs\IContactUs;
use App\Repositories\User\IUsers;
use App\Repositories\User\Authentication;
use App\Repositories\City\Cities;
use App\Repositories\City\ICities;
use App\Repositories\Province\IProvinces;
use App\Repositories\Province\Provinces;
use App\Repositories\User\Users;
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
        $this->app->when([AdminController::class,AuthenticationController::class,ProfileController::class])->needs(IUsers::class)->give(function () {
                return new Authentication();
            });
        $this->app->when(UserController::class)->needs(IUsers::class)->give(function () {
            return new Users();
        });
        $this->app->bind(IProvinces::class,Provinces::class);
        $this->app->bind(ICities::class,Cities::class);
        $this->app->bind(IUserGroups::class,UserGroups::class);
        $this->app->bind(IContactUs::class,ContactUs::class);
        $this->app->bind(IBrands::class,Brands::class);
        $this->app->bind(ICategories::class,Categories::class);
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
