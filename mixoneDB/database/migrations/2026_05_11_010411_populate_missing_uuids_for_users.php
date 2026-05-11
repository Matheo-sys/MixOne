<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        \App\Models\User::whereNull('uuid')->get()->each(function ($user) {
            $user->uuid = (string) \Illuminate\Support\Str::uuid();
            $user->save();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rien à faire ici
    }
};
