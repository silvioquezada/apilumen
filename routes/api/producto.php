<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('productos', 'Almacen\ProductoController@index');
    $router->post('productos', 'Almacen\ProductoController@store');
});

$router->group(['prefix' => 'api', 'middleware' => 'jwt'], function () use ($router) {
    //$router->get('productos', 'Almacen\ProductoController@index');
    //$router->post('productos', 'Almacen\ProductoController@store');
    $router->get('productos/{id}', 'Almacen\ProductoController@show');
    $router->put('productos/{id}', 'Almacen\ProductoController@update');
    $router->delete('productos/{id}', 'Almacen\ProductoController@destroy');
});

$router->get('/reporte/productos', 'Almacen\ReporteProductoController@productos');

//$router->get('/perfil', ['middleware' => 'jwt','uses' => 'Usuario\UsuarioController@perfil']);