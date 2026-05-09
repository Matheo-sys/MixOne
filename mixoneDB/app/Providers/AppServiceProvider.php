<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        if (app()->isProduction()) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Helper global pour gérer les URLs Cloudinary vs Local
        if (!function_exists('storage_url')) {
            function storage_url($path) {
                if (!$path) return null;
                return str_starts_with($path, 'http') ? $path : \Illuminate\Support\Facades\Storage::url($path);
            }
        }
    }
}
