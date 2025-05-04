<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeerCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    public function beers()
    {
        return $this->hasMany(Beer::class);
    }
}
