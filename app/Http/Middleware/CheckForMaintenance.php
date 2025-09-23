<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckForMaintenance
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if maintenance mode is enabled
        if (config('app.maintenance_mode', false)) {
            // Allow access to maintenance form submission
            if ($request->is('maintenance/contact') && $request->isMethod('post')) {
                return $next($request);
            }
            
            // Redirect all other requests to maintenance page
            if (!$request->is('maintenance')) {
                return redirect('/maintenance');
            }
        }
        
        return $next($request);
    }
}