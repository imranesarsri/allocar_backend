# Install 
## Install laravel project
```bash
composer create-project laravel/laravel .
```

## Breeze and next js
```bash
composer require laravel/breeze
php artisan breeze:install
    . API Only
    . Pest
```


## Middlewares

1. Create the Middleware

```bash
php artisan make:middleware ValidateId
```

2. Register the Middleware
- After creating the middleware, you need to register it in the **bootstrap/app.php** file. Specifically, you should add it to the $middleware->alias array:

```bash
$middleware->alias([
    ...
    'ValidateId' => \App\Http\Middleware\ValidateId::class,
]);
```


## Form request
```bash
php artisan make:request TestRequest
```
- change namespace


## JWT

```bash
;extension=sodium

composer install --ignore-platform-req=ext-sodium

php artisan jwt:secret

```
