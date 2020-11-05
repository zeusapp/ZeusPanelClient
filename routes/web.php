<?php

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

Route::get('/','HomeController@index')->middleware("auth");

Auth::routes(['verify' => true]);

Route::resource('/profile', 'ProfileController', [
    'only' => ['index', 'create', 'update']
])->middleware("auth");

Route::get('/dashboard',function () {
    return view('welcome');
})->name('dashboard')->middleware("auth");
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->middleware("auth");
Route::resource('/admin/daemons', 'DaemonsController');
