<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeerFavorite extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'beer_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function beer()
    {
        return $this->belongsTo(Beer::class);
    }
}
