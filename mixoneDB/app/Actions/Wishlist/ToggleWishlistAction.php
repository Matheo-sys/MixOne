<?php

namespace App\Actions\Wishlist;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class ToggleWishlistAction
{
    public function execute(int $studioId): string
    {
        $userId = Auth::id();

        $wishlist = Wishlist::where('user_id', $userId)
            ->where('studio_id', $studioId)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return 'removed';
        }

        Wishlist::create([
            'user_id' => $userId,
            'studio_id' => $studioId
        ]);

        return 'added';
    }
}
