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

Route::group(['prefix' => 'auth'], function () {
    Route::get('/', 'AuthController@me');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
});

Route::get('health/check', 'HealthController@check');
Route::get('/', function () use ($router) {
    return 'Hello, this is macarame-api service.';
});


$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    // Customer
    $api->get('customers', 'App\Http\Controllers\CustomerController@index');
    $api->get('customers/{customer_uuid}', 'App\Http\Controllers\CustomerController@show');
    $api->post('customers', 'App\Http\Controllers\CustomerController@store');
    $api->put('customers/{customer_uuid}', 'App\Http\Controllers\CustomerController@update');
    $api->delete('customers/{customer_uuid}', 'App\Http\Controllers\CustomerController@delete');

    // Product 
    $api->get('products', 'App\Http\Controllers\ProductController@index');
    $api->get('products/{product_id}', 'App\Http\Controllers\ProductController@show');
    $api->post('products', 'App\Http\Controllers\ProductController@store');
    $api->put('products/{product_id}', 'App\Http\Controllers\ProductController@update');
    $api->delete('products/{product_id}', 'App\Http\Controllers\ProductController@delete');
});

// Item Products (Menu)
Route::get('menus', [
    'as' => 'menus.index',
    'uses' => 'MenuController@index'
]);
Route::get('menus/{menu_id}', [
    'as' => 'menus.show',
    'uses' => 'MenuController@show'
]);
Route::post('menus', [
    'as' => 'menus.store',
    'uses' => 'MenuController@store'
]);
Route::put('menus/{menu_id}', [
    'as' => 'menus.update',
    'uses' => 'MenuController@update'
]);


