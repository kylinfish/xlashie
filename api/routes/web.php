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

Route::middleware('auth')->group(function () {
    Route::get('/','IndexController@index');

    Route::get('/company/', 'CompanyController@show');
    Route::get('/company/create', 'CompanyController@create');
    Route::post('/company/', 'CompanyController@store');



    Route::get('/dashboard/', function () {
        return view('dashboard');
    });
    Route::get('/calendar/', function () {
        return view('calendar');
    });


    Route::get('/customers/search', 'CustomerController@search');
    Route::resource('customers', 'CustomerController');
    Route::resource('products', 'ProductController');
    Route::get('products/create', 'ProductController@create');
    Route::resource('menus', 'MenuController');

});

/*
    Login
*/

// Social Login
Route::prefix('login')->group(function () {
    Route::post('/', [
        'as' => 'login.general',
        'uses' => 'Auth\LoginController@login'
    ]);

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

// General Login
Route::get('/auth/register/', function () {
    return view('register');
});
Route::get('/auth/login/', function () {
    return view('login');
})->name('auth.login');

Route::get('/auth/logout/', 'Auth\LoginController@logout');
Route::get('/company/{en_name}/landing', 'CompanyController@landing');
Route::get('/company/{en_name}/login', 'CompanyController@landing');
Route::get('/company/{en_name}/register', 'CompanyController@register');
Route::post('/company/{en_name}/register', 'CompanyController@register');
Route::get('/company/{en_name}/done', 'CompanyController@done');

Route::prefix('customer/register')->group(function () {
    Route::get('facebook/{id}', [
        'uses' => 'CompanyController@facebook'
    ]);
    Route::get('facebook/callback', [
        'uses' => 'CompanyController@facebookCallback'
    ]);
    Route::get('google/{id}', [
        'uses' => 'CompanyController@google'
    ]);
    Route::get('google/callback', [
        'uses' => 'CompanyController@googleCallback'
    ]);
});