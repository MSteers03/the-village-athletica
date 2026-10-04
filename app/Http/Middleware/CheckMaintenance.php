<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if maintenance mode is enabled. Serve the maintenance page with a
        // 503 so search engines treat the outage as temporary and keep the
        // original pages indexed, rather than following a redirect.
        if (env('MAINTENANCE_MODE', false)) {
            return response()->view('maintenance', [], 503)->header('Retry-After', '3600');
        }

        return $next($request);
    }
}