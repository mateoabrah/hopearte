<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Beer;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Verificamos primero si la columna ya tiene constraint unique
        $hasUniqueConstraint = false;
        $indexes = DB::select("SHOW INDEXES FROM beers WHERE Column_name = 'slug' AND Non_unique = 0");
        if (!empty($indexes)) {
            $hasUniqueConstraint = true;
        }

        // Si no tenemos constraint unique, procedemos a actualizar los slugs y añadir el constraint
        if (!$hasUniqueConstraint) {
            // 1. Generar slugs únicos para todos los registros existentes
            $beers = DB::table('beers')->get();
            foreach ($beers as $beer) {
                // Si el nombre existe, generamos un slug único
                if (!empty($beer->name)) {
                    $slug = Str::slug($beer->name);
                    
                    // Verificamos si el slug ya existe y añadimos un sufijo numérico si es necesario
                    $count = 1;
                    $originalSlug = $slug;
                    while (DB::table('beers')->where('slug', $slug)->where('id', '!=', $beer->id)->exists()) {
                        $slug = $originalSlug . '-' . $count++;
                    }
                    
                    // Actualizamos el registro con el slug único
                    DB::table('beers')->where('id', $beer->id)->update(['slug' => $slug]);
                } else {
                    // Si no hay nombre, generamos un slug basado en el ID
                    DB::table('beers')->where('id', $beer->id)->update(['slug' => 'beer-' . $beer->id]);
                }
            }

            // 2. Ahora que todos los slugs son únicos, añadimos la restricción unique
            Schema::table('beers', function (Blueprint $table) {
                // Aseguramos que no sea nullable
                $table->string('slug')->nullable(false)->change();
                $table->unique('slug');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('beers', function (Blueprint $table) {
            $table->dropUnique(['slug']);
        });
    }
};
