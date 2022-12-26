<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\CityController;
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

Route::get('/', function () {
    return view('pages.index');
})->name('home');
Route::get('/account', function () {
    return view('pages.contact-us');
});
Route::get('/thankYou', function () {
    return view('pages.UserAccount.thankyou');
});
Route::get('/cart', function () {
    return view('pages.UserAccount.wishlist');
});
Route::get('/admin2', function () {
    return view('admin.pages.index');
});

Route::get('/account', [UserController::class,'index'])->name('account');
Route::post('/UserAccount', [UserController::class,'store'])->name('UserAccount');
Route::post('/login', [UserController::class,'login'])->name('login');
Route::get('/logout', [UserController::class,'logout'])->name('logout');
Route::group(['namespace'=>'UserAccount','middleware'=>'checkUserLogin'],function () {
    Route::get('/UserDashboard', [UserController::class,'show'])->name('UserDashboard');
    Route::put('/UpdateProfile', [UserController::class,'update'])->name('UpdateProfile');
    Route::put('/UpdatePassword', [UserController::class,'updatePassword'])->name('UpdatePassword');
});
Route::group(['namespace'=>'admin/pages','middleware'=>'checkAdminLogin'],function () {
    Route::get('/AdminDashboard', [AdminController::class,'index'])->name('AdminDashboard');
    Route::get('/AdminDashboard/Profile', [AdminController::class,'show'])->name('Profile');
    Route::put('/AdminDashboard/UpdateProfile', [AdminController::class,'update'])->name('UpdateAdminProfile');
    Route::put('/AdminDashboard/UpdatePassword', [AdminController::class,'updatePassword'])->name('UpdateAdminPassword');
    Route::get('/AdminDashboard/Provinces', [ProvinceController::class,'index'])->name('ProvincesList');
    Route::post('/AdminDashboard/AddProvince', [ProvinceController::class,'store'])->name('AddProvince');
    Route::get('/AdminDashboard/DeleteProvince/{id}', [ProvinceController::class,'destroy'])->name('DestroyProvince');
    Route::get('/AdminDashboard/ChangeProvinceStatus/{id}/{status}', [ProvinceController::class,'editStatus'])->name('ChangeProvinceStatus');
    Route::get('/AdminDashboard/EditProvince/{id}', [ProvinceController::class,'edit'])->name('EditProvince');
    Route::put('/AdminDashboard/UpdateProvince/{id}', [ProvinceController::class,'update'])->name('UpdateProvince');

    Route::get('/AdminDashboard/Cities', [CityController::class,'index'])->name('CitiesList');
    Route::post('/AdminDashboard/AddCity', [CityController::class,'store'])->name('AddCity');
    Route::get('/AdminDashboard/DeleteCity/{id}', [CityController::class,'destroy'])->name('DestroyCity');
    Route::get('/AdminDashboard/ChangeCityStatus/{id}/{status}', [CityController::class,'editStatus'])->name('ChangeCityStatus');
    Route::get('/AdminDashboard/EditCity/{id}', [CityController::class,'edit'])->name('EditCity');
    Route::put('/AdminDashboard/UpdateCity/{id}', [CityController::class,'update'])->name('UpdateCity');

});
