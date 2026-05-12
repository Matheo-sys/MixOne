<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Migration critique :
     * 1. Remplit les usernames vides des utilisateurs existants
     * 2. Ajoute une contrainte d'unicité sur le champ username
     */
    public function up(): void
    {
        // Étape 1 : Remplir les usernames vides pour les comptes existants
        $users = DB::table('users')->whereNull('username')->orWhere('username', '')->get();

        foreach ($users as $user) {
            // Générer un username basé sur prénom.nom
            $base = Str::slug($user->first_name . '.' . $user->last_name, '.');
            $base = preg_replace('/[^a-z0-9._]/', '', strtolower($base));

            // S'assurer qu'il fait au moins 3 caractères
            if (strlen($base) < 3) {
                $base = 'user' . $user->id;
            }

            // Tronquer à 30 caractères max
            $base = substr($base, 0, 30);

            // Vérifier l'unicité et ajouter un suffixe si nécessaire
            $username = $base;
            $counter = 1;
            while (DB::table('users')->where('username', $username)->where('id', '!=', $user->id)->exists()) {
                $suffix = (string) $counter;
                $username = substr($base, 0, 30 - strlen($suffix)) . $suffix;
                $counter++;
            }

            DB::table('users')->where('id', $user->id)->update(['username' => $username]);
        }

        // Étape 2 : Ajouter la contrainte d'unicité
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 30)->nullable(false)->change();
            $table->unique('username');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['username']);
            $table->string('username')->nullable()->change();
        });
    }
};
