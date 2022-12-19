<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
    Route::get('/UserDashboard', [UserController::class,'show'])->name('show');
    Route::put('/UpdateProfile', [UserController::class,'update'])->name('UpdateProfile');
    Route::put('/UpdatePassword', [UserController::class,'updatePassword'])->name('UpdatePassword');
});
