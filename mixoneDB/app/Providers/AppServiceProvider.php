<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Bridge\Brevo\Transport\BrevoTransportFactory;
use Symfony\Component\Mailer\Transport\Dsn;

/**
 * Définition globale du helper storage_url.
 * On le place ici, en dehors de la classe, pour qu'il soit accessible partout
 * sans risque de double déclaration lors du boot de Laravel.
 */
if (!function_exists('storage_url')) {
    function storage_url($path) {
        if (empty($path)) return null;
        if (str_starts_with($path, 'http')) return $path;
        return \Illuminate\Support\Facades\Storage::url($path);
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

        Mail::extend('brevo', function (array $config) {
            return (new BrevoTransportFactory)->create(
                new Dsn(
                    'brevo+api',
                    'default',
                    $config['key'] ?? config('services.brevo.key')
                )
            );
        });
    }
}
