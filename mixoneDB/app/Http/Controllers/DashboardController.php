<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    /**
     * Redirige les utilisateurs vers leur tableau de bord spécifique selon leur profil.
     */
    public function index(): RedirectResponse
    {
        if (Auth::user()->profile === 'artist') {
            return redirect()->route('dashboard.artist.index');
        }

        return redirect()->route('dashboard.studio');
    }
}

