<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreweryFavorite extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'brewery_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function brewery()
    {
        return $this->belongsTo(Brewery::class);
    }
}
