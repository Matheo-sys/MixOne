<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $view = auth()->user()->profile == 'artist' ? 'dashboard.artist.booking' : 'dashboard.studio.dashboard';

        return view($view);
    }
}
