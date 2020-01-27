<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('health/check', 'HealthController@check');
Route::get('/', function () use ($router) {
    return 'Hello, this is macarame-api service.';
});
Route::prefix('login')->group(function () {
    Route::get('facebook', [
        'as' => 'login.facebook',
        'uses' => 'Auth\LoginController@facebook'
    ]);
    Route::get('facebook/callback', [
        'as' => 'login.facebookcallback',
        'uses' => 'Auth\LoginController@facebookCallback'
    ]);
});

// Customer
Route::get('customers', [
    'as' => 'customers.index',
    'uses' => 'CustomerController@index'
]);
Route::get('customers/{cusotmer_uuid}', [
    'as' => 'customers.show',
    'uses' => 'CustomerController@show'
]);
Route::post('customer', [
    'as' => 'customers.store',
    'uses' => 'CustomerController@store'
]);
Route::put('customers/{cusotmer_uuid}', [
    'as' => 'customers.update',
    'uses' => 'CustomerController@update'
]);
Route::delete('customers/{cusotmer_uuid}', [
    'as' => 'customers.delete',
    'uses' => 'CustomerController@delete'
]);
