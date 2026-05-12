<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectToMainDomain
{
    /**
     * Handle an incoming request.
     *
     * Redirige les requêtes provenant du domaine Railway ou du domaine nu
     * vers le domaine canonique www.mixone.fr pour le SEO et la cohérence.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();
        $targetDomain = 'www.mixone.fr';

        // Ne pas rediriger les webhooks (Stripe, etc.) pour éviter de perdre les POST
        if ($request->isMethod('POST') || $request->isMethod('PUT') || $request->isMethod('DELETE')) {
            return $next($request);
        }

        // Domaines à rediriger vers le canonique
        $domainsARediriger = [
            'mixone.up.railway.app',    // Domaine Railway
            'mixone.fr',                 // Domaine nu (sans www)
        ];

        if (in_array($host, $domainsARediriger)) {
            return redirect()->to(
                'https://' . $targetDomain . $request->getRequestUri(),
                301
            );
        }

        return $next($request);
    }
}
