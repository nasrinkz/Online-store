<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\UserGroupController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\AddressController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ShoppingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class,'index'])->name('home');

Route::get('/contactUs', [ContactController::class,'index'])->name('contactUs');
Route::post('/addContactUs', [ContactController::class,'store'])->name('addContactUs');
Route::get('/Shop', [ShoppingController::class,'index'])->name('Shop');
Route::get('/Sales', [ShoppingController::class,'sales'])->name('Sales');
Route::get('/ProductDetails/{id}', [ShoppingController::class,'details'])->name('ProductDetails');
Route::get('/Categories', [ShoppingController::class,'categories'])->name('Categories');

Route::get('/account', [AuthenticationController::class,'index'])->name('account');
Route::post('/UserAccount', [AuthenticationController::class,'store'])->name('UserAccount');
Route::post('/login', [AuthenticationController::class,'login'])->name('login');
Route::get('/logout', [AuthenticationController::class,'logout'])->name('logout');
Route::post('/addCart', [OrderController::class,'addCart'])->name('addCart');
Route::get('/cartList', [OrderController::class,'cartList'])->name('cartList');
Route::get('/removeFromCart/{id}', [OrderController::class,'removeFromCart'])->name('removeFromCart');
Route::post('/checkCoupon', [OrderController::class,'checkCoupon'])->name('checkCoupon');
Route::get('/FetchCity/{id}', [UserController::class,'fetchCity'])->name('FetchCity');

Route::group(['namespace'=>'UserAccount','middleware'=>'checkUserLogin','prefix'=>'UserDashboard'],function () {
    Route::get('', [ProfileController::class,'show'])->name('UserDashboard');
    Route::put('/UpdateProfile', [ProfileController::class,'update'])->name('UpdateProfile');
    Route::put('/UpdatePassword', [ProfileController::class,'updatePassword'])->name('UpdatePassword');
    Route::get('/addWish/{productId}', [OrderController::class,'addWish'])->name('addWish');
    Route::get('/removeWish/{productId}', [OrderController::class,'removeWish'])->name('removeWish');
    Route::get('/wishList', [OrderController::class,'wishList'])->name('wishList');
    Route::get('/removeWishFromList/{productId}', [OrderController::class,'removeWishFromList'])->name('removeWishFromList');
    Route::get('/MyAddress', [AddressController::class,'editUserAddress'])->name('EditMyAddress');
    Route::put('/UpdateUserAddress/{id}', [UserController::class,'updateUserAddress'])->name('UpdateMyAddress');
});

Route::group(['namespace'=>'admin/pages','middleware'=>'checkAdminLogin','prefix'=>'AdminDashboard'],function () {
    Route::get('', [AdminController::class,'index'])->name('AdminDashboard');
    Route::get('/Profile', [AdminController::class,'show'])->name('Profile');
    Route::put('/UpdateProfile', [AdminController::class,'update'])->name('UpdateAdminProfile');
    Route::put('/UpdatePassword', [AdminController::class,'updatePassword'])->name('UpdateAdminPassword');

    Route::get('/Provinces', [ProvinceController::class,'index'])->name('ProvincesList');
    Route::post('/AddProvince', [ProvinceController::class,'store'])->name('AddProvince');
    Route::get('/DeleteProvince/{id}', [ProvinceController::class,'destroy'])->name('DestroyProvince');
    Route::get('/ChangeProvinceStatus/{id}/{status}', [ProvinceController::class,'editStatus'])->name('ChangeProvinceStatus');
    Route::get('/EditProvince/{id}', [ProvinceController::class,'edit'])->name('EditProvince');
    Route::put('/UpdateProvince/{id}', [ProvinceController::class,'update'])->name('UpdateProvince');

    Route::get('/Cities', [CityController::class,'index'])->name('CitiesList');
    Route::post('/AddCity', [CityController::class,'store'])->name('AddCity');
    Route::get('/DeleteCity/{id}', [CityController::class,'destroy'])->name('DestroyCity');
    Route::get('/ChangeCityStatus/{id}/{status}', [CityController::class,'editStatus'])->name('ChangeCityStatus');
    Route::get('/EditCity/{id}', [CityController::class,'edit'])->name('EditCity');
    Route::put('/UpdateCity/{id}', [CityController::class,'update'])->name('UpdateCity');

    Route::get('/UserGroups', [UserGroupController::class,'index'])->name('UserGroupsList');

    Route::get('/Users', [UserController::class,'index'])->name('UsersList');
    Route::post('/AddUser', [UserController::class,'store'])->name('AddUser');
    Route::get('/DeleteUser/{id}', [UserController::class,'destroy'])->name('DestroyUser');
    Route::get('/ChangeUserStatus/{id}/{status}', [UserController::class,'editStatus'])->name('ChangeUserStatus');
    Route::get('/EditUser/{id}', [UserController::class,'edit'])->name('EditUser');
    Route::put('/UpdateUser/{id}', [UserController::class,'update'])->name('UpdateUser');
    Route::get('/UserAddress/{id}', [UserController::class,'editUserAddress'])->name('EditUserAddress');
    Route::put('/UpdateUserAddress/{id}', [UserController::class,'updateUserAddress'])->name('UpdateUserAddress');

    Route::get('/Messages', [ContactUsController::class,'index'])->name('MessagesList');
    Route::get('/ShowDetails/{id}', [ContactUsController::class,'details'])->name('ShowDetails');

    Route::get('/Brands', [BrandController::class,'index'])->name('BrandsList');
    Route::post('/AddBrand', [BrandController::class,'store'])->name('AddBrand');
    Route::get('/DeleteBrand/{id}', [BrandController::class,'destroy'])->name('DestroyBrand');
    Route::get('/ChangeBrandStatus/{id}/{status}', [BrandController::class,'editStatus'])->name('ChangeBrandStatus');
    Route::get('/EditBrand/{id}', [BrandController::class,'edit'])->name('EditBrand');
    Route::put('/UpdateBrand/{id}', [BrandController::class,'update'])->name('UpdateBrand');

    Route::get('/Categories', [CategoryController::class,'index'])->name('CategoriesList');
    Route::post('/AddCategory', [CategoryController::class,'store'])->name('AddCategory');
    Route::get('/DeleteCategory/{id}', [CategoryController::class,'destroy'])->name('DestroyCategory');
    Route::get('/ChangeCategoryStatus/{id}/{status}', [CategoryController::class,'editStatus'])->name('ChangeCategoryStatus');
    Route::get('/EditCategory/{id}', [CategoryController::class,'edit'])->name('EditCategory');
    Route::put('/UpdateCategory/{id}', [CategoryController::class,'update'])->name('UpdateCategory');

    Route::get('/Sizes', [SizeController::class,'index'])->name('SizesList');
    Route::post('/AddSize', [SizeController::class,'store'])->name('AddSize');
    Route::get('/DeleteSize/{id}', [SizeController::class,'destroy'])->name('DestroySize');
    Route::get('/ChangeSizeStatus/{id}/{status}', [SizeController::class,'editStatus'])->name('ChangeSizeStatus');
    Route::get('/EditSize/{id}', [SizeController::class,'edit'])->name('EditSize');
    Route::put('/UpdateSize/{id}', [SizeController::class,'update'])->name('UpdateSize');

    Route::get('/Colors', [ColorController::class,'index'])->name('ColorsList');
    Route::post('/AddColor', [ColorController::class,'store'])->name('AddColor');
    Route::get('/DeleteColor/{id}', [ColorController::class,'destroy'])->name('DestroyColor');
    Route::get('/ChangeColorStatus/{id}/{status}', [ColorController::class,'editStatus'])->name('ChangeColorStatus');
    Route::get('/EditColor/{id}', [ColorController::class,'edit'])->name('EditColor');
    Route::put('/UpdateColor/{id}', [ColorController::class,'update'])->name('UpdateColor');

    Route::get('/Coupons', [CouponController::class,'index'])->name('CouponsList');
    Route::post('/AddCoupon', [CouponController::class,'store'])->name('AddCoupon');
    Route::get('/DeleteCoupon/{id}', [CouponController::class,'destroy'])->name('DestroyCoupon');
    Route::get('/ChangeCouponStatus/{id}/{status}', [CouponController::class,'editStatus'])->name('ChangeCouponStatus');
    Route::get('/EditCoupon/{id}', [CouponController::class,'edit'])->name('EditCoupon');
    Route::put('/UpdateCoupon/{id}', [CouponController::class,'update'])->name('UpdateCoupon');

    Route::get('/Products', [ProductController::class,'index'])->name('ProductsList');
    Route::post('/AddProduct', [ProductController::class,'store'])->name('AddProduct');
    Route::get('/DeleteProduct/{id}', [ProductController::class,'destroy'])->name('DestroyProduct');
    Route::get('/ChangeProductStatus/{id}/{status}', [ProductController::class,'editStatus'])->name('ChangeProductStatus');
    Route::get('/EditProduct/{id}', [ProductController::class,'edit'])->name('EditProduct');
    Route::put('/UpdateProduct/{id}', [ProductController::class,'update'])->name('UpdateProduct');
    Route::post('/DeleteProductImage/{id}', [ProductController::class,'deleteImage'])->name('DeleteProductImage');
    Route::put('/UpdateProductGallery/{id}', [ProductController::class,'updateGallery'])->name('UpdateProductGallery');

});
