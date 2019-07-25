<?php



$router->group(['middleware' => ['auth']], function () use ($router) {

    $router->post('/users/login',['uses'=> 'ClientController@getToken']);
    $router->post('/clients/login',['uses'=> 'ClientController@getToken']);

    $router->get('/client/{id}',['uses'=> 'ClientController@getClient']);
    $router->get('/clients',['uses'=> 'ClientController@getClients']);
    $router->post('/client',['uses'=> 'ClientController@create']);
    $router->post('/client/update',['uses'=> 'ClientController@create']);
    $router->put('/client/{id}',['uses'=> 'ClientController@delete']);


    $router->get('/product/{id}',['uses'=> 'ProductController@getClient']);
    $router->get('/products',['uses'=> 'ProductController@getClients']);
    $router->post('/product',['uses'=> 'ProductController@create']);
    $router->post('/product/update',['uses'=> 'ProductController@create']);
    $router->put('/product/{id}',['uses'=> 'ProductController@delete']);


    $router->get('/order/{id}',['uses'=> 'ClientController@getClient']);
    $router->get('/orders',['uses'=> 'ClientController@getClients']);
    $router->post('/order',['uses'=> 'ClientController@create']);
    $router->post('/order/update',['uses'=> 'ClientController@create']);
    $router->put('/order/{id}',['uses'=> 'OrdersController@delete']);


    $router->get('/client/{id}',['uses'=> 'ClientController@getClient']);
    $router->get('/clients',['uses'=> 'ClientController@getClients']);
    $router->post('/client',['uses'=> 'ClientController@create']);
    $router->post('/client/update',['uses'=> 'ClientController@create']);
    $router->put('/client/{id}',['uses'=> 'ClientController@delete']);
});
