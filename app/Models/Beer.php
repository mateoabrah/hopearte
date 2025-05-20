<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    use HasFactory;

    protected $fillable = [
        'brewery_id',
        'beer_category_id',
        'name',
        'description',
        'abv',
        'ibu',
        'color',
        'image',
        'first_brewed',
        'seasonal',
        'featured_in_banner',
    ];

    protected $casts = [
        'abv' => 'decimal:2',
        'ibu' => 'decimal:2',
        'first_brewed' => 'integer',
        'seasonal' => 'boolean',
    ];

    public function brewery()
    {
        return $this->belongsTo(Brewery::class);
    }

    /**
     * Relación con la categoría de cerveza
     */
    public function category()
    {
        return $this->belongsTo(BeerCategory::class, 'beer_category_id');
    }

    /**
     * Relación muchos a muchos con cervecerías
     */
    public function breweries()
    {
        return $this->belongsToMany(Brewery::class, 'brewery_beer');
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'beer_favorites');
    }
    
    /**
     * Obtener todas las reseñas de esta cerveza
     */
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
    
    /**
     * Calcular la calificación promedio
     */
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?: 0;
    }
}
