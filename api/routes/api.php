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

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth'], function () {
    // Customers
    Route::get('customers/', 'Customers@index');
    Route::get('customers/{customer_uuid}/', 'Customers@show');
    Route::post('customers/{customer_uuid}/', 'Customers@store');
    Route::put('customers/{customer_uuid}/', 'Customers@update');

    // Inventories
    Route::get('customers/{customer_uuid}/inventories', 'Inventories@index');
    Route::put('customers/{customer_uuid}/inventories/status', 'Inventories@update');

    // Note
    Route::get('customers/{customer_uuid}/notes', 'Invnotes@index');
    Route::get('customers/{customer_uuid}/notes/{note_id}', 'Invnotes@show');
    Route::post('customers/{customer_uuid}/notes/', 'Invnotes@store');
    Route::put('customers/{customer_uuid}/notes/{note_id}', 'Invnotes@update');
    Route::delete('customers/{customer_uuid}/notes/{note_id}', 'Invnotes@destroy');

    // Transactions
    Route::get('customers/{customer_uuid}/transactions', 'Transactions@index');
    Route::get('customers/{customer_uuid}/transactions/{id}/', 'Transactions@detail');
    Route::post('customers/{customer_uuid}/transactions/', 'Transactions@store');
    Route::delete('customers/{customer_uuid}/transactions/{id}/', 'Transactions@delete');

    // Menus
    Route::get('menus', 'Menus@index');
    Route::get('menus/{menu_id}', 'Menus@show');

    // Products
    Route::get('products', 'Products@index');
    Route::get('products/{product_id}', 'Products@show');

    // Report / Dashboard
    Route::get('reports/', 'Reports@index');
});
