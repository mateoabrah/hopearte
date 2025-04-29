<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeerCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // Relación con el modelo Beer
    public function beers()
    {
        return $this->hasMany(Beer::class, 'category_id');
    }
}
