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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'stripe_account_id')) {
                $table->string('stripe_account_id')->nullable()->after('profile');
            }
            
            // On supprime les anciennes colonnes bancaires manuelles
            if (Schema::hasColumn('users', 'bank_name')) {
                $table->dropColumn(['bank_name', 'iban', 'bic']);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('stripe_account_id');
            $table->string('bank_name')->nullable();
            $table->string('iban')->nullable();
            $table->string('bic')->nullable();
        });
    }
};
