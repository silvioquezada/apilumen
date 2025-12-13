# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

## Contributing

Thank you for considering contributing to Lumen! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).




## Instalación
composer create-project --prefer-dist laravel/lumen:8.x apilumen

En la consola PowerShell o CMD desactivamos la auditoria porque son librerias antiguas
composer config audit.block-insecure false

Agregamos
"audit": {
    "block-insecure": false
},

Luego instalamos las librerías para PHP 7.4
composer require firebase/php-jwt:"5.5.1"
composer require barryvdh/laravel-dompdf:"^1.0"

Para PHP 8.0
"require": {
    "php": "^7.3|^8.0",
    "barryvdh/laravel-dompdf": "^2.2",
    "firebase/php-jwt": "^6.11",
    "laravel/lumen-framework": "^8.3.1"
},


## Ejecutar Local
php -S localhost:8000 -t public

## JWT
composer require firebase/php-jwt
Crea el archivo
app/Http/Middleware/JwtMiddleware.php
En bootstrap/app.php Agregar
```php
$app->routeMiddleware([
    'jwt' => App\Http\Middleware\JwtMiddleware::class,
]);

```

Crea el archivo
app/Services/JWTService.php



## CORS
Crea el archivo:
app/Http/Middleware/CorsMiddleware.php  
Registrar el middleware en bootstrap/app.php  
Debajo de donde registras tu middleware JWT, agrega:

```php
$app->middleware([
    App\Http\Middleware\CorsMiddleware::class,
]);
```


#### DOMPDF
composer require barryvdh/laravel-dompdf

Habilitar las funciones necesarias en Lumen  
bootstrap/app.php  

$app->register(Barryvdh\DomPDF\ServiceProvider::class);

Y si deseas usar la facade PDF, también habilita el alias:  

class_alias(Barryvdh\DomPDF\Facade::class, 'PDF');

Habilitar las vistas en Lumen (importante)  
Si NO has habilitado las vistas, debes hacerlo  
En bootstrap/app.php, activa:  

$app->configure('view');
$app->register(Illuminate\View\ViewServiceProvider::class);