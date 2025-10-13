<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $column = 'id'): Response
    {
        // Get the ID from the route
        $id = $request->route($column);

        // 1. Check if the ID is present
        if (!$id) {
            return response()->json(['message' => 'ID is missing'], 400);
        }

        // 2. Validate that the ID is a valid number and not malicious (e.g., <script> tags)
        if (!is_numeric($id) || preg_match('/[^0-9]/', $id)) {
            return response()->json(['message' => 'ID is not valid'], 400);
        }

        return $next($request);
    }
}
