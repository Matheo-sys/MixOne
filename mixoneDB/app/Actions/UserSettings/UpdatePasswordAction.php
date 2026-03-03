<?php

namespace App\Actions\UserSettings;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;

class UpdatePasswordAction
{
    public function execute(User $user, string $currentPassword, string $newPassword): bool
    {
        if (!Hash::check($currentPassword, $user->password)) {
            throw new Exception('Le mot de passe actuel est incorrect');
        }

        return $user->update([
            'password' => Hash::make($newPassword)
        ]);
    }
}
