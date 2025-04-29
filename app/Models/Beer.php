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
        'alcohol_percentage',
        'image', // si quieres permitir que se suban imágenes
    ];

    public function category()
    {
        return $this->belongsTo(BeerCategory::class, 'category_id');
    }
}
