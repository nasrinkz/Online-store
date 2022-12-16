<?php

use Illuminate\Support\Facades\Route;

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
