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


$router->group(['namespace' => '\App\Http\Controllers\V1', 'prefix' => 'api'], function () use ($router) {

    $router->post('/login', 'AuthenticationController@login');
    $router->post('/register', 'AuthenticationController@register');
    
    //GET DATA
    
    
    $router->group(['middleware' => ['jwt.auth']], function () use ($router) {
        $router->get('/producto/{slug}', 'ProductosController@getProducto');
        $router->get('/productos', 'ProductosController@getProductos');
        $router->get('/productos/categorias', 'ProductosController@getCategorias');
        $router->get('/productos/favoritos', 'ProductosController@getProductosFavoritos');
        $router->get('/productos/cart', 'ProductosController@getProductosCart');
        $router->get('/productos/cart/add', 'ProductosController@addCart');
        $router->get('/productos/toggle/favorito', 'ProductosController@toggleFavorito');

        $router->get('/pedidos/', 'PedidosController@getPedidos');
        $router->post('/pedidos/nuevo', 'PedidosController@nuevoPedido');
        $router->get('/mis-pedidos/', 'PedidosController@getMyPedidos');

        $router->get('/user/profile','UserController@getMyProfile');
        $router->post('/user/update', 'UserController@updateUser');
    });


   


    $router->get('/migration', 'ProductosController@migrationCategorias');
});
