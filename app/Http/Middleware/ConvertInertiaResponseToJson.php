<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ConvertInertiaResponseToJson
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (strpos($request->url(), '/api/') !== false && !$response->headers->get('X-Inertia')) {
            $response->header('Content-Type', 'application/json');
        }

        return $response;
    }
}
