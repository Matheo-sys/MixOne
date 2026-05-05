<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ajout des index manquants pour optimiser les requêtes fréquentes.
     */
    public function up(): void
    {
        // Index sur reservations
        Schema::table('reservations', function (Blueprint $table) {
            $table->index('status');
            $table->index(['studio_id', 'date', 'time_slot'], 'reservations_availability_index');
        });

        // Index sur messages
        Schema::table('messages', function (Blueprint $table) {
            $table->index(['receiver_id', 'is_read'], 'messages_unread_index');
            $table->index('sender_id');
        });

        // Index unique sur wishlists pour éviter les doublons
        Schema::table('wishlists', function (Blueprint $table) {
            $table->unique(['user_id', 'studio_id'], 'wishlists_user_studio_unique');
        });

        // Index unique sur wallets
        Schema::table('wallets', function (Blueprint $table) {
            $table->unique('user_id', 'wallets_user_unique');
        });

        // Index sur hidden_conversations
        Schema::table('hidden_conversations', function (Blueprint $table) {
            $table->unique(['user_id', 'contact_id'], 'hidden_conversations_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex('reservations_availability_index');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->dropIndex('messages_unread_index');
            $table->dropIndex(['sender_id']);
        });

        Schema::table('wishlists', function (Blueprint $table) {
            $table->dropUnique('wishlists_user_studio_unique');
        });

        Schema::table('wallets', function (Blueprint $table) {
            $table->dropUnique('wallets_user_unique');
        });

        Schema::table('hidden_conversations', function (Blueprint $table) {
            $table->dropUnique('hidden_conversations_unique');
        });
    }
};
