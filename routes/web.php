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
    'uses' => 'CustomersController@index'
]);
$router->get('customers/{customer_id}', [
    'as' => 'customers.show',
    'uses' => 'CustomersController@show'
]);
$router->post('customer', [
    'as' => 'customers.store',
    'uses' => 'CustomersController@store'
]);
$router->put('customer/{customer_id}', [
    'as' => 'customers.update',
    'uses' => 'CustomersController@update'
]);
$router->delete('customer/{customer_id}', [
    'as' => 'customers.delete',
    'uses' => 'CustomersController@delete'
]);