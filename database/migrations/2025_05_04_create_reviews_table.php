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
        // Verificar si la tabla ya existe
        if (!Schema::hasTable('reviews')) {
            Schema::create('reviews', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->morphs('reviewable'); // Crea reviewable_id y reviewable_type
                $table->integer('rating')->comment('Calificación de 1 a 5');
                $table->text('comment')->nullable();
                $table->timestamps();

                // Un usuario solo puede dejar una reseña por cerveza/cervecería
                $table->unique(['user_id', 'reviewable_id', 'reviewable_type']);
            });
        } else {
            // Añadir nuevos campos o restricciones a la tabla existente
            Schema::table('reviews', function (Blueprint $table) {
                // Aquí podrías añadir nuevos campos si es necesario
                // $table->string('nuevo_campo')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};