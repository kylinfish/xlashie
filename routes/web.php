<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('health/check', 'HealthController@check');
$router->get('/', function () use ($router) {
    return 'Hello, this is macarame-api service.';
});

// Customer
$router->get('customers', [
    'as' => 'customers.index',
    'uses' => 'CustomerController@index'
]);
$router->get('customers/{shop_id}/{cusotmer_uuid}', [
    'as' => 'customers.show',
    'uses' => 'CustomerController@show'
]);
$router->post('customer', [
    'as' => 'customers.store',
    'uses' => 'CustomerController@store'
]);
$router->put('customers/{shop_id}/{cusotmer_uuid}', [
    'as' => 'customers.update',
    'uses' => 'CustomerController@update'
]);
$router->delete('customers/{shop_id}/{cusotmer_uuid}', [
    'as' => 'customers.delete',
    'uses' => 'CustomerController@delete'
]);
