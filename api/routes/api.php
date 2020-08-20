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



$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    // Customers
    $api->get('customers/{customer_uuid}/', 'App\Http\Controllers\Api\Customers@show');
    $api->post('customers/{customer_uuid}/', 'App\Http\Controllers\Api\Customers@store');
    $api->put('customers/{customer_uuid}/', 'App\Http\Controllers\Api\Customers@update');

    // Inventories
    $api->get('customers/{customer_uuid}/inventories', 'App\Http\Controllers\Api\Inventories@index');
    $api->put('customers/{customer_uuid}/inventories/status', 'App\Http\Controllers\Api\Inventories@update');

    // Note
    $api->get('customers/{customer_uuid}/notes', 'App\Http\Controllers\Api\InvNotes@index');
    $api->get('customers/{customer_uuid}/notes/{note_id}', 'App\Http\Controllers\Api\InvNotes@show');
    $api->post('customers/{customer_uuid}/notes/', 'App\Http\Controllers\Api\InvNotes@store');
    $api->put('customers/{customer_uuid}/notes/{note_id}', 'App\Http\Controllers\Api\InvNotes@update');

    // Transactions
    $api->get('customers/{customer_uuid}/transactions', 'App\Http\Controllers\Api\Transactions@index');
    $api->get('customers/{customer_uuid}/transactions/{id}/', 'App\Http\Controllers\Api\Transactions@detail');
    $api->post('customers/{customer_uuid}/transactions/', 'App\Http\Controllers\Api\Transactions@store');


    // Menus
    $api->get('menus', 'App\Http\Controllers\Api\Menus@index');

    // Products
    $api->get('products', 'App\Http\Controllers\Api\Products@index');
    $api->get('products/{product_id}', 'App\Http\Controllers\Api\Products@show');


});