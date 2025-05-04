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
        Schema::create('beers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brewery_id')->constrained()->onDelete('cascade');
            $table->foreignId('beer_category_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name');
            $table->text('description');
            $table->decimal('abv', 4, 2)->nullable()->comment('Alcohol By Volume');
            $table->decimal('ibu', 5, 2)->nullable()->comment('International Bitterness Units');
            $table->string('color')->nullable();
            $table->string('image')->nullable();
            $table->year('first_brewed')->nullable();
            $table->boolean('seasonal')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beers');
    }
};
