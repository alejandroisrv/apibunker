<?php



$router->group(['middleware' => ['auth']], function () use ($router) {

    $router->get('/client',['uses'=> 'ClientController@getClient']);
});
