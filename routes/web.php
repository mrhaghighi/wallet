<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () {
    return 'Welcome to the Wallet Project';
});

$router->get('/balances/{userId}', [
    'as' => 'balance', 'uses' => 'WalletController@show'
]);

$router->post('/add-money', [
    'as' => 'addMoney', 'uses' => 'WalletController@store'
]);