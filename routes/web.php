<?php
require __DIR__ . '/api/usuario.php';
require __DIR__ . '/api/producto.php';

$router->get('/', function () use ($router) {
    return $router->app->version();
});