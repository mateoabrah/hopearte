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
        // Solo ejecuta si la tabla beer_categories existe y la columna beer_category_id no existe en beers
        if (Schema::hasTable('beer_categories') && !Schema::hasColumn('beers', 'beer_category_id')) {
            Schema::table('beers', function (Blueprint $table) {
                $table->foreignId('beer_category_id')->nullable()->after('brewery_id')->constrained()->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('beers') && Schema::hasColumn('beers', 'beer_category_id')) {
            Schema::table('beers', function (Blueprint $table) {
                $table->dropForeign(['beer_category_id']);
                $table->dropColumn('beer_category_id');
            });
        }
    }
};
