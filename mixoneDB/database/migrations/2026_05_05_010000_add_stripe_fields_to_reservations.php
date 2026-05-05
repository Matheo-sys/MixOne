<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ajoute les champs nécessaires au paiement Stripe sur les réservations.
     */
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('payment_status')->default('pending')->after('status');
            $table->string('stripe_session_id')->nullable()->after('payment_status');
            $table->string('stripe_payment_id')->nullable()->after('stripe_session_id');
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['payment_status', 'stripe_session_id', 'stripe_payment_id']);
        });
    }
};
