<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->route('lang');
        if ($locale && in_array($locale, ['en', 'fr', 'ar'])) {
            App::setLocale($locale);
        }

        return $next($request);
    }

    
}