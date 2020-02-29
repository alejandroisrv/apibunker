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

$router->post('/login', 'AuthenticationController@login');

$router->group(['middleware' => 'auth:usuarios'], function () use ($router) {
    $router->post('/add/user', 'AuthenticationController@createUser');
    $router->get('/pedidos/all', 'PedidosController@getPedidos');
    $router->get('/pedidos/changeState', 'PedidosController@changeStatePedido');
});
