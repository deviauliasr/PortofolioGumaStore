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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard')->middleware('is_admin');
Route::get('admin', 'AdminController@admin');
Route::post('konfirmasi/{id}', 'AdminController@konfirmasi');

Route::get('detail/{id}', 'CartController@index');
Route::post('detail/{id}', 'CartController@add');
Route::get('cart', 'CartController@tas');
Route::delete('cart/{id}', 'CartController@delete');
Route::get('check-out', 'CartController@checkout');
Route::post('check-out', 'CartController@checkpost');
Route::post('up-profile', 'CartController@uppost');
Route::post('up-bukti/{id}', 'CartController@bukti');

Route::get('profile', 'ProfileController@index');
Route::post('profile', 'ProfileController@edit');

Route::get('history', 'HistoryController@index');
Route::get('history/{id}', 'HistoryController@detail')->name('history.detail');

