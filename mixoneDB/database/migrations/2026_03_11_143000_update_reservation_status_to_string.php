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
            // Passer d'un enum limité à un string plus flexible pour gérer tous les statuts
            $table->string('status')->default('En attente')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->enum('status', ['en attente', 'confirmée', 'annulée'])->default('en attente')->change();
        });
    }
};
