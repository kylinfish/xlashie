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

Route::get('/', function () {
    return view('welcome');
});

Route::get('company', function () {
    return view('companies.index');
});
Route::get('/dashboard/', function () {
    return view('dashboard');
});
Route::get('/calendar/', function () {
    return view('calendar');
});
Route::get('/login/', function () {
    return view('login');
});
Route::get('/register/', function () {
    return view('register');
});

Route::resource('customers', 'CustomerController');
Route::resource('products', 'ProductController');
Route::resource('menus', 'MenuController');


Route::prefix('login')->group(function () {
    Route::get('facebook', [
        'as' => 'login.facebook',
        'uses' => 'Auth\LoginController@facebook'
    ]);
    Route::get('facebook/callback', [
        'as' => 'login.facebookcallback',
        'uses' => 'Auth\LoginController@facebookCallback'
    ]);
    Route::get('google', [
        'as' => 'login.google',
        'uses' => 'Auth\LoginController@google'
    ]);
    Route::get('google/callback', [
        'as' => 'login.googlecallback',
        'uses' => 'Auth\LoginController@googleCallback'
    ]);
});
