<?php

namespace App\Actions\UserSettings;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\Studio;

class DeleteAccountAction
{
    /**
     * Execute the account deletion.
     */
    public function execute(User $user): void
    {
        // 1. Delete user avatar if exists
        if ($user->avatar) {
            Storage::delete($user->avatar);
        }

        // 2. Delete studio images for all studios owned by the user
        $studios = Studio::where('user_id', $user->id)->get();
        foreach ($studios as $studio) {
            if ($studio->image_path) {
                Storage::delete($studio->image_path);
            }
            // If there are multiple images, handle them here if applicable
        }

        // 3. Delete the user (database cascades will handle the rest)
        $user->delete();
    }
}
