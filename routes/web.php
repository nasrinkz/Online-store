<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\UserGroupController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\User\ProfileController;


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

Route::get('/account', [AuthenticationController::class,'index'])->name('account');
Route::post('/UserAccount', [AuthenticationController::class,'store'])->name('UserAccount');
Route::post('/login', [AuthenticationController::class,'login'])->name('login');
Route::get('/logout', [AuthenticationController::class,'logout'])->name('logout');
Route::group(['namespace'=>'UserAccount','middleware'=>'checkUserLogin','prefix'=>'UserDashboard'],function () {
    Route::get('', [ProfileController::class,'show'])->name('UserDashboard');
    Route::put('/UpdateProfile', [ProfileController::class,'update'])->name('UpdateProfile');
    Route::put('/UpdatePassword', [ProfileController::class,'updatePassword'])->name('UpdatePassword');
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
    Route::get('/FetchCity/{id}', [UserController::class,'fetchCity'])->name('FetchCity');
    Route::get('/{id}', [UserController::class,'editUserAddress'])->name('EditUserAddress');
    Route::put('/UpdateUserAddress/{id}', [UserController::class,'updateUserAddress'])->name('UpdateUserAddress');
});
