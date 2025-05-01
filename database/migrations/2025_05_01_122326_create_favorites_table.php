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
        // Tabla para favoritos de cervezas
        if (!Schema::hasTable('beer_favorites')) {
            Schema::create('beer_favorites', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('beer_id');
                $table->timestamps();
                $table->unique(['user_id', 'beer_id']);
                
                // Comentamos las restricciones para evitar errores
                // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                // $table->foreign('beer_id')->references('id')->on('beers')->onDelete('cascade');
            });
        }

        // Tabla para favoritos de cervecerías
        if (!Schema::hasTable('brewery_favorites')) {
            Schema::create('brewery_favorites', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('brewery_id');
                $table->timestamps();
                $table->unique(['user_id', 'brewery_id']);
                
                // Comentamos las restricciones para evitar errores
                // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                // $table->foreign('brewery_id')->references('id')->on('breweries')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beer_favorites');
        Schema::dropIfExists('brewery_favorites');
    }
};
