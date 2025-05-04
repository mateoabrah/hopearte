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
        Schema::create('brewery_beer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brewery_id')->constrained()->onDelete('cascade');
            $table->foreignId('beer_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            // Opcionalmente puedes agregar una restricción de unicidad
            $table->unique(['brewery_id', 'beer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brewery_beer');
    }
};