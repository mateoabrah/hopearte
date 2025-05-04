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
        Schema::create('breweries', function (Blueprint $table) {
            $table->id();
            // Primero creamos la columna sin la restricción de clave foránea
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->text('description');
            $table->string('city');
            $table->string('address');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->year('founded_year')->nullable();
            $table->string('website')->nullable();
            $table->boolean('visitable')->default(false);
            $table->string('image')->nullable();
            $table->timestamps();
            
            // Asegurar que la tabla users exista antes de crear la clave foránea
            // Añadimos la restricción después de crear todas las columnas
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breweries');
    }
};
