<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    /**
     * Redirect users to their specific dashboard based on profile.
     */
    public function index(): RedirectResponse
    {
        if (Auth::user()->profile === 'artist') {
            return redirect()->route('dashboard.artist.index');
        }

        return redirect()->route('dashboard.studio');
    }
}
