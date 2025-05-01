<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brewery extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'location',
        'image_url'
    ];
    
    // Relación con las cervezas
    public function beers()
    {
        return $this->hasMany(Beer::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'brewery_favorites', 'brewery_id', 'user_id')->withTimestamps();
    }
}
