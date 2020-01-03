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

<<<<<<< HEAD
$router->group(['namespace' => '\App\Http\Controllers\V1','prefix' => 'api'],
    function () use ($router) {
        $router->post('/authenticate', 'AuthenticationController@authenticate');
        $router->post('/user', 'UserController@store');


        $router->get('/productos','ProductosController@getProductos ');
    });
=======
$router->group(['namespace' => '\App\Http\Controllers\V1', 'prefix' => ''],function () use ($router) {
        $router->post('authenticate', 'AuthenticationController@authenticate');
        $router->post('user', 'UserController@store');
    }
);
>>>>>>> 17f690ad6db077ee8a0f88aed4040a0432887d6a
