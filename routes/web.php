<?php



$router->post('/users/login',['uses'=> 'UsersController@getToken']);

$router->group(['middleware' => ['auth']], function () use ($router) {

    

    $router->post('/client',['uses'=> 'ClientController@create']);
    $router->get('/clients',['uses'=> 'ClientController@getClients']);
    $router->get('/client/{id}',['uses'=> 'ClientController@getClient']);
    $router->post('/client/update',['uses'=> 'ClientController@create']);
    $router->put('/client/{id}',['uses'=> 'ClientController@delete']);
    

    $router->post('/product',['uses'=> 'ProductController@create']);
    $router->get('/product/{id}',['uses'=> 'ProductController@getProduct']);
    $router->get('/products',['uses'=> 'ProductController@getProducts']);
    $router->post('/product/update',['uses'=> 'ProductController@update']);
    $router->put('/product/{id}',['uses'=> 'ProductController@delete']);


    $router->post('/order',['uses'=> 'OrdersController@create']);
    $router->get('/order/{id}',['uses'=> 'OrdersController@getOrder']);
    $router->get('/orders',['uses'=> 'OrdersController@getOrders']);
    $router->post('/order/delivered',['uses'=> 'OrdersController@delivered']);
    $router->put('/order/{id}',['uses'=> 'OrdersController@delete']);


    $router->get('/pay/{id}',['uses'=> 'PayController@getPay']);
    $router->get('/pays',['uses'=> 'PayController@getPays']);
    $router->post('/pay',['uses'=> 'PayController@create']);
    $router->post('/pay/update',['uses'=> 'PayController@create']);
    $router->put('/pay/{id}',['uses'=> 'PayController@delete']);

    


});
