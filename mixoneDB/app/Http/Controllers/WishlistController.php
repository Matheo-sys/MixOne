<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $favoriteStudios = Auth::user()->favoriteStudios;
        return view('dashboard.artist.wishlist', compact('favoriteStudios'));
    }

    public function toggle(Request $request)
    {
        // Vérifier que l'utilisateur est connecté
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Vous devez être connecté pour ajouter un studio aux favoris'
            ]);
        }

        $studioId = $request->studio_id;
        $userId = Auth::id();

        // Vérifier si ce studio est déjà dans les favoris
        $wishlist = Wishlist::where('user_id', $userId)
            ->where('studio_id', $studioId)
            ->first();

        if ($wishlist) {
            // Si existe, on supprime des favoris
            $wishlist->delete();
            $status = 'removed';
        } else {
            // Sinon on ajoute aux favoris
            Wishlist::create([
                'user_id' => $userId,
                'studio_id' => $studioId
            ]);
            $status = 'added';
        }

        return response()->json([
            'success' => true,
            'status' => $status
        ]);
    }
}
