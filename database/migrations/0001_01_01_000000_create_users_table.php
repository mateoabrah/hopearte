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
        // Crear la tabla 'users'
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Columna 'id' auto-incremental
            $table->string('name'); // Columna 'name' de tipo string
            $table->string('email')->unique(); // Columna 'email' de tipo string y única
            $table->timestamp('email_verified_at')->nullable(); // Columna 'email_verified_at' de tipo timestamp y puede ser nula
            $table->string('password'); // Columna 'password' de tipo string
            $table->enum('role', ['user', 'company', 'admin'])->default('user'); // Columna 'role' de tipo enum con valores 'user', 'company', 'admin' y valor por defecto 'user'
            $table->rememberToken(); // Columna 'remember_token' de tipo string
            $table->timestamps(); // Columnas 'created_at' y 'updated_at' de tipo timestamp
        });

        // Crear la tabla 'password_reset_tokens'
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Columna 'email' de tipo string y primaria
            $table->string('token'); // Columna 'token' de tipo string
            $table->timestamp('created_at')->nullable(); // Columna 'created_at' de tipo timestamp y puede ser nula
        });

        // Crear la tabla 'sessions'
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Columna 'id' de tipo string y primaria
            $table->foreignId('user_id')->nullable()->index(); // Columna 'user_id' de tipo foreignId, puede ser nula y con índice
            $table->string('ip_address', 45)->nullable(); // Columna 'ip_address' de tipo string con longitud 45 y puede ser nula
            $table->text('user_agent')->nullable(); // Columna 'user_agent' de tipo text y puede ser nula
            $table->longText('payload'); // Columna 'payload' de tipo longText
            $table->integer('last_activity')->index(); // Columna 'last_activity' de tipo integer y con índice
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar la tabla 'users'
        Schema::dropIfExists('users');
        // Eliminar la tabla 'password_reset_tokens'
        Schema::dropIfExists('password_reset_tokens');
        // Eliminar la tabla 'sessions'
        Schema::dropIfExists('sessions');
    }
};
