<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'abv',
        'ibu',
        'image_url',
        'beer_category_id',
        'brewery_id', // Asegúrate de que este campo esté aquí
    ];

    // Relación con la categoría
    public function category()
    {
        return $this->belongsTo(\App\Models\BeerCategory::class, 'category_id');
    }

    // Relación con la cervecería (añade esto)
    public function brewery()
    {
        return $this->belongsTo(Brewery::class, 'brewery_id');
    }

    // Añadir dentro de la clase Beer
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'beer_favorites', 'beer_id', 'user_id')->withTimestamps();
    }
}
