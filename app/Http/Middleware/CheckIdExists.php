<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class CheckIdExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $table, $column = 'id'): Response
    {
        // Get the ID from the route
        $id = $request->route($column);

        // Debugging log (Check what ID is retrieved)
        Log::info("Checking ID existence: Table = $table, Column = $column, ID = " . json_encode($id));


        // If no ID is found, return 404
        if (!DB::table($table)->where($column, $id)->exists()) {
            return response()->json(['message' => 'Resource not found'], 404);
        }

        return $next($request);
    }
}
