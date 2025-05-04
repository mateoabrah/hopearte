<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;

class ReviewPolicy
{
    /**
     * Determinar si el usuario puede actualizar la reseña.
     */
    public function update(User $user, Review $review): bool
    {
        // Solo el creador de la reseña puede editarla
        return $user->id === $review->user_id;
    }

    /**
     * Determinar si el usuario puede eliminar la reseña.
     */
    public function delete(User $user, Review $review): bool
    {
        // El creador de la reseña o un administrador puede eliminarla
        return $user->id === $review->user_id || $user->is_admin;
    }
}