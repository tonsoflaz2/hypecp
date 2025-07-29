<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreloadCache
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // Set cache headers for preload routes
        $response->header('Cache-Control', 'public, max-age=60');
        
        return $response;
    }
} 