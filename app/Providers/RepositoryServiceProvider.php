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
use App\Repositories\Color\Colors;
use App\Repositories\Color\IColors;
use App\Repositories\ContactUs\ContactUs;
use App\Repositories\ContactUs\IContactUs;
use App\Repositories\Coupon\Coupons;
use App\Repositories\Coupon\ICoupons;
use App\Repositories\Main\IMain;
use App\Repositories\Main\Main;
use App\Repositories\Product\IProducts;
use App\Repositories\Product\Products;
use App\Repositories\Shop\IShop;
use App\Repositories\Shop\Shop;
use App\Repositories\Size\ISizes;
use App\Repositories\Size\Sizes;
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
        $this->app->bind(ISizes::class,Sizes::class);
        $this->app->bind(IColors::class,Colors::class);
        $this->app->bind(ICoupons::class,Coupons::class);
        $this->app->bind(IProducts::class,Products::class);
        $this->app->bind(IMain::class,Main::class);
        $this->app->bind(IShop::class,Shop::class);
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
