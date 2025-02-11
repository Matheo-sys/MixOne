<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('pages.home', [
            'studios' => Studio::all()
        ]);
    }
}
