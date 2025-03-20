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
            $table->date('date')->after('studio_id');
            $table->integer('number_of_hours')->after('date');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            if (Schema::hasColumn('reservations', 'date')) {
                $table->dropColumn('date');
            }
            if (Schema::hasColumn('reservations', 'number_of_hours')) {
                $table->dropColumn('number_of_hours');
            }
        });
    }
};
