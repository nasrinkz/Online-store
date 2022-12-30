<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\UserGroupController;
use App\Http\Controllers\Admin\UserController;

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
Route::group(['namespace'=>'UserAccount','middleware'=>'checkUserLogin'],function () {
    Route::get('/UserDashboard', [AuthenticationController::class,'show'])->name('UserDashboard');
    Route::put('/UpdateProfile', [AuthenticationController::class,'update'])->name('UpdateProfile');
    Route::put('/UpdatePassword', [AuthenticationController::class,'updatePassword'])->name('UpdatePassword');
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

    Route::get('/AdminDashboard/UserGroups', [UserGroupController::class,'index'])->name('UserGroupsList');

    Route::get('/AdminDashboard/Users', [UserController::class,'index'])->name('UsersList');
    Route::post('/AdminDashboard/AddCity', [UserController::class,'store'])->name('AddUser');
    Route::get('/AdminDashboard/DeleteUser/{id}', [UserController::class,'destroy'])->name('DestroyUser');
    Route::get('/AdminDashboard/ChangeUserStatus/{id}/{status}', [UserController::class,'editStatus'])->name('ChangeUserStatus');
    Route::get('/AdminDashboard/EditUser/{id}', [UserController::class,'edit'])->name('EditUser');
    Route::put('/AdminDashboard/UpdateUser/{id}', [UserController::class,'update'])->name('UpdateUser');
    Route::get('/AdminDashboard/FetchCity/{id}', [UserController::class,'fetchCity'])->name('FetchCity');
    Route::get('/AdminDashboard/EditUserAddress/{id}', [UserController::class,'editUserAddress'])->name('EditUserAddress');
    Route::put('/AdminDashboard/UpdateUserAddress/{id}', [UserController::class,'updateUserAddress'])->name('UpdateUserAddress');
//    Route::get('/AdminDashboard/getCourse/{id}', function ($id) {
//        $course = \App\Models\City::where('province_id',$id)->get();
//        return response()->json($course);
//    });
});
