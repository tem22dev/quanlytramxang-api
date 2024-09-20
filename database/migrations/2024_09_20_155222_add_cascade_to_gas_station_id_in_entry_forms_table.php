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
        Schema::table('entry_forms', function (Blueprint $table) {
            $table->foreign('gas_station_id')->references('id')->on('gas_stations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entry_forms', function (Blueprint $table) {
            $table->dropForeign(['gas_station_id']);
        });
    }
};
