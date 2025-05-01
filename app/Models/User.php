<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function beerFavorites()
    {
        return $this->hasMany(BeerFavorite::class);
    }

    public function breweryFavorites()
    {
        return $this->hasMany(BreweryFavorite::class);
    }

    public function favoritedBeers()
    {
        return $this->belongsToMany(Beer::class, 'beer_favorites', 'user_id', 'beer_id')->withTimestamps();
    }

    public function favoritedBreweries()
    {
        return $this->belongsToMany(Brewery::class, 'brewery_favorites', 'user_id', 'brewery_id')->withTimestamps();
    }
}
