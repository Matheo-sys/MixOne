<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Définition globale du helper storage_url.
 * On le place ici, en dehors de la classe, pour qu'il soit accessible partout
 * sans risque de double déclaration lors du boot de Laravel.
 */
if (!function_exists('storage_url')) {
    function storage_url($path) {
        if (!$path) return null;
        return str_starts_with($path, 'http') ? $path : \Illuminate\Support\Facades\Storage::url($path);
    }
}

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
    }
}
