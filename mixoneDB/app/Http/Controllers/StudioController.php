<?php

namespace App\Http\Controllers;

use App\Http\Requests\Studio\CreateRequest;
use App\Models\Studio;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
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

    /**
     * Create a studio
     * @param CreateRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request) {
        // Retrieve all form data
        $formData = $request->array();

        // Remove _token from the array
        unset($formData['_token']);

        // Add id user to the form data
        $formData['user_id'] = auth()->user()->id;

        // Create the studio
        $studio = Studio::create($formData);

        return redirect()->route('studio.show', ['studio' => $studio]);
    }
}
