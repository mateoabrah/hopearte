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
        Schema::table('beers', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->constrained('users');
            
            // Añadimos la columna brewery_id que puede ser nullable inicialmente
            // para permitir que la migración se ejecute con registros existentes
            $table->foreignId('brewery_id')->nullable()->constrained('breweries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('beers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('created_by');
            $table->dropConstrainedForeignId('brewery_id');
        });
    }
};
