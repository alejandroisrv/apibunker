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


$router->group(['namespace' => '\App\Http\Controllers\V1','prefix' => 'api'],function () use ($router) {
    
    $router->post('/authenticate', 'AuthenticationController@authenticate');
    $router->post('/user', 'UserController@store');

    $router->get('/productos','ProductosController@getProductos');
    $router->get('/productos/{slug}','ProductosController@getProducto');
    $router->get('/productos/categorias','ProductosController@getCategorias');

    $router->get('/pedidos/','PedidosController@getPedidos');
    $router->get('/mis-pedidos/','PedidosController@getMyPedidos');

});
