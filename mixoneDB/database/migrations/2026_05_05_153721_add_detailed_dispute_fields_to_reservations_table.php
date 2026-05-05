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
        Schema::table('reservations', function (Blueprint $table) {
            $table->text('dispute_description')->nullable()->after('dispute_reason');
            $table->string('dispute_image')->nullable()->after('dispute_description');
            $table->text('admin_notes')->nullable()->after('dispute_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['dispute_description', 'dispute_image', 'admin_notes']);
        });
    }
};
