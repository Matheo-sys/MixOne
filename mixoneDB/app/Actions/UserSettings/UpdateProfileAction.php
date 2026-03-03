<?php

namespace App\Actions\UserSettings;

use App\DTOs\UpdateProfileDTO;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UpdateProfileAction
{
    public function execute(User $user, UpdateProfileDTO $dto): bool
    {
        $data = $dto->toArray();

        // Handle Avatar removal
        if ($dto->remove_avatar) {
            if ($user->avatar && $user->avatar !== 'media/img/misc/avatar-1.png') {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->avatar = null;
        }
        // Handle Avatar upload
        elseif ($dto->avatar) {
            if ($user->avatar && $user->avatar !== 'media/img/misc/avatar-1.png') {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->avatar = $dto->avatar->store('avatars', 'public');
        }

        return $user->fill($data)->save();
    }
}
