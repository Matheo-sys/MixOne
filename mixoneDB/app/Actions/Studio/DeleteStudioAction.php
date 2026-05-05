<?php

namespace App\Actions\Studio;

use App\Models\Studio;
use Illuminate\Support\Facades\Storage;

class DeleteStudioAction
{
    public function execute(Studio $studio): bool
    {
        // Cleanup images
        for ($i = 1; $i <= 4; $i++) {
            $field = "image{$i}";
            if ($studio->$field) {
                Storage::delete($studio->$field);
            }
        }

        return $studio->delete();
    }
}
