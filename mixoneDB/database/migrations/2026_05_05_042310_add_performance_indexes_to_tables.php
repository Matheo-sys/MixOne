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
        Schema::table('studios', function (Blueprint $table) {
            $table->index('is_verified');
            $table->index('city');
            $table->index('hourly_rate');
            $table->index(['latitude', 'longitude']); // Composite index for geo search
        });

        Schema::table('users', function (Blueprint $table) {
            $table->index('is_admin');
            $table->index('banned_at');
            $table->index('email_verified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('studios', function (Blueprint $table) {
            $table->dropIndex(['is_verified']);
            $table->dropIndex(['city']);
            $table->dropIndex(['hourly_rate']);
            $table->dropIndex(['latitude', 'longitude']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['is_admin']);
            $table->dropIndex(['banned_at']);
            $table->dropIndex(['email_verified_at']);
        });
    }
};
