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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();
        $targetDomain = 'www.mixone.fr';

        // Redirection si l'utilisateur accède via l'URL Railway
        if ($host === 'mixone.up.railway.app') {
            return redirect()->to('https://' . $targetDomain . $request->getRequestUri(), 301);
        }

        return $next($request);
    }
}
