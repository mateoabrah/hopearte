<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'reviewable_id',
        'reviewable_type',
        'comment',
        'rating',
    ];

    /**
     * Los atributos que deben ser convertidos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rating' => 'integer',
    ];

    /**
     * Las reglas de validación para las reseñas.
     *
     * @var array<string, string>
     */
    public static $rules = [
        'comment' => 'nullable|string|max:500',  // Cambiado de 'required' a 'nullable'
        'rating' => 'required|integer|min:1|max:5',
    ];

    /**
     * Obtiene el usuario que escribió la reseña.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtiene el modelo que está siendo reseñado (cerveza o cervecería).
     */
    public function reviewable()
    {
        return $this->morphTo();
    }

    /**
     * Obtiene la calificación con estrellas.
     *
     * @return string
     */
    public function getStarsAttribute()
    {
        $stars = str_repeat('★', $this->rating);
        $emptyStars = str_repeat('☆', 5 - $this->rating);
        return $stars . $emptyStars;
    }
}