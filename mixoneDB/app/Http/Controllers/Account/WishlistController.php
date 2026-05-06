<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

use App\Actions\Wishlist\ToggleWishlistAction;
use App\Http\Requests\Wishlist\ToggleWishlistRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class WishlistController extends Controller
{
    public function __construct(
        private readonly ToggleWishlistAction $actionBasculeFavoris
    ) {}

    /**
     * Affiche la liste des studios favoris de l'utilisateur.
     *
     * @return View
     */
    public function afficher(): View
    {
        $studiosFavoris = Auth::user()->studiosFavoris;
        return view('dashboard.artist.wishlist', ['studiosFavoris' => $studiosFavoris]);
    }


    /**
     * Ajoute ou retire un studio des favoris.
     *
     * @param ToggleWishlistRequest $requete
     * @return JsonResponse
     */
    public function basculer(ToggleWishlistRequest $requete): JsonResponse
    {
        $statut = $this->actionBasculeFavoris->executer($requete->studio_id);

        return response()->json([
            'success' => true,
            'status' => $statut
        ]);
    }


}
