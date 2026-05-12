<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Mapping des anciennes valeurs vers les nouvelles
        $mapping = [
            'En attente' => 'pending',
            'Confirmée'  => 'confirmed',
            'Refusée'    => 'refused',
            'Annulée'    => 'cancelled',
            'Terminée'   => 'completed',
            'Litige'     => 'disputed',
        ];

        foreach ($mapping as $old => $new) {
            DB::table('reservations')
                ->where('status', $old)
                ->update(['status' => $new]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $mapping = [
            'pending'   => 'En attente',
            'confirmed' => 'Confirmée',
            'refused'   => 'Refusée',
            'cancelled' => 'Annulée',
            'completed' => 'Terminée',
            'disputed'  => 'Litige',
        ];

        foreach ($mapping as $new => $old) {
            DB::table('reservations')
                ->where('status', $new)
                ->update(['status' => $old]);
        }
    }
};
