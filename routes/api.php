<?php

use Illuminate\Support\Facades\Route;

Route::prefix('{lang?}')
    ->where(['lang' => 'en|fr|ar'])
    ->middleware(\App\Http\Middleware\LocaleMiddleware::class)
    ->group(function () {

        // Include package routes
        require_once __DIR__ . '/pkg_parameters.php';
        require_once __DIR__ . '/auth.php';
        require_once __DIR__ . '/pkg_cars.php';
        require_once __DIR__ . '/pkg_blogs.php';
        require_once __DIR__ . '/pkg_reviews.php';
        require_once __DIR__ . '/pkg_configs.php';
        require_once __DIR__ . '/pkg_agencies.php';
        require_once __DIR__ . '/pkg_subscriptions.php';
        require_once __DIR__ . '/pkg_authorizations.php';
    });