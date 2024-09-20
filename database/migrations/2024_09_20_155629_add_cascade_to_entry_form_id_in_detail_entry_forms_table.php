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
        Schema::table('detail_entry_forms', function (Blueprint $table) {
            $table->foreign('entry_form_id')->references('id')->on('entry_forms')->onDelete('cascade');
            $table->foreign('fuel_id')->references('id')->on('fuels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_entry_forms', function (Blueprint $table) {
            $table->dropForeign(['entry_form_id']);
            $table->dropForeign(['fuel_id']);
        });
    }
};
