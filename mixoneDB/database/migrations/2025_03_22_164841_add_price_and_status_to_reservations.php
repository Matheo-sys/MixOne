<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('reservations', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->after('number_of_hours')->nullable();
            $table->enum('status', ['en attente', 'confirmée', 'annulée'])->default('en attente')->after('price');
        });
    }

    public function down() {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['price', 'status']);
        });
    }
};
