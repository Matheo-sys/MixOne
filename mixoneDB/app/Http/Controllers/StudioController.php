<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    /**
     * Afficher la page d'un studio
     *
     * @return Factory|View|Application
     */
    public function show(Studio $studio) {

        return view('studios.single', [
            'studio' => $studio,
        ]);
    }
}
