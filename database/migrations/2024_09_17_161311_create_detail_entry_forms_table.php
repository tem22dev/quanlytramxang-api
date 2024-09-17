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
        Schema::create('detail_entry_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entry_form_id')->nullable()->default(null);
            $table->unsignedBigInteger('fuel_id')->nullable()->default(null);
            $table->integer('quantity');
            $table->float('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_entry_forms');
    }
};
