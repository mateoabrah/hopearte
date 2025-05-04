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
        // Primero, modificamos la columna 'role' existente para cambiarla a string/varchar
        DB::statement("ALTER TABLE users MODIFY role VARCHAR(255) NOT NULL DEFAULT 'user'");
        
        // Actualizar valores existentes
        DB::statement("UPDATE users SET role = 'user' WHERE role = 'persona'");
        DB::statement("UPDATE users SET role = 'company' WHERE role = 'empresa'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Si necesitas revertir, volvemos al enum original
        DB::statement("ALTER TABLE users MODIFY role ENUM('persona','empresa') NOT NULL");
    }
};
