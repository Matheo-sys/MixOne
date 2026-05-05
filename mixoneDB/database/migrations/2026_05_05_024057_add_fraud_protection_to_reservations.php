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
            $table->string('pin_code', 10)->nullable()->after('payment_status');
            $table->timestamp('disputed_at')->nullable()->after('stripe_payment_id');
            $table->text('dispute_reason')->nullable()->after('disputed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['pin_code', 'disputed_at', 'dispute_reason']);
        });
    }
};
