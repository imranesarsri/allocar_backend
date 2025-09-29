<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::fallback(function () {
    return response()->json([
        'error' => [
            'message' => 'Ressource non trouvée',
            'code' => 404,
            'requested_url' => request()->url(),
        ]
    ], 404);
});

