<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS when NOT in local development
        // This covers production, staging, and Vercel preview deployments
        if (!$this->app->environment('local')) {
            URL::forceScheme('https');
        }
        
        // Alternative: Always force HTTPS on Vercel
        // if (isset($_SERVER['VERCEL'])) {
        //     URL::forceScheme('https');
        // }
    }
}