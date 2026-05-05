<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Studio;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    public function index()
    {
        $studios = Studio::with('user')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.studios.index', compact('studios'));
    }

    public function destroy(Studio $studio)
    {
        $studio->delete();
        return redirect()->route('admin.studios.index')->with('success', 'Studio supprimé avec succès.');
    }

    public function toggleVerify(Studio $studio)
    {
        $studio->is_verified = !$studio->is_verified;
        $studio->save();

        $status = $studio->is_verified ? 'vérifié' : 'non vérifié';
        return redirect()->back()->with('success', "Le studio est désormais $status.");
    }
}
