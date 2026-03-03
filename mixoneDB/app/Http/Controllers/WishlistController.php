<?php

namespace App\Http\Controllers;

use App\Actions\Wishlist\ToggleWishlistAction;
use App\Http\Requests\Wishlist\ToggleWishlistRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class WishlistController extends Controller
{
    public function __construct(
        private ToggleWishlistAction $toggleWishlistAction
    ) {}

    public function index(): View
    {
        $favoriteStudios = Auth::user()->favoriteStudios;
        return view('dashboard.artist.wishlist', compact('favoriteStudios'));
    }

    public function toggle(ToggleWishlistRequest $request): JsonResponse
    {
        $status = $this->toggleWishlistAction->execute($request->studio_id);

        return response()->json([
            'success' => true,
            'status' => $status
        ]);
    }
}
