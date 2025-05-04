<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Añadimos role a los campos asignables en masa
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Determina si el usuario es administrador.
     *
     * @return bool
     */
    public function getIsAdminAttribute()
    {
        return $this->role === 'admin';
    }

    /**
     * Determina si el usuario es una empresa.
     *
     * @return bool
     */
    public function getIsCompanyAttribute()
    {
        return $this->role === 'company';
    }

    /**
     * Relación con las cervecerías que son propiedad de este usuario (solo para empresas).
     */
    public function breweries()
    {
        return $this->hasMany(Brewery::class);
    }

    /**
     * Relación con las cervecerías favoritas del usuario.
     */
    public function favoritedBreweries()
    {
        return $this->belongsToMany(Brewery::class, 'brewery_favorites');
    }

    /**
     * Relación con las cervezas favoritas del usuario.
     */
    public function favoritedBeers()
    {
        return $this->belongsToMany(Beer::class, 'beer_favorites');
    }

    /**
     * Relación con las reseñas escritas por el usuario.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
