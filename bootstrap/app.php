<?php

use App\Http\Middleware\CheckIdExists;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Define middleware aliases
        $middleware->alias([
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
            'checkIdExists' => \App\Http\Middleware\CheckIdExists::class,
            'ValidateId' => \App\Http\Middleware\ValidateId::class,
        ]);

        // Exclude API routes from CSRF protection
        // $middleware->validateCsrfTokens(except: [
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
