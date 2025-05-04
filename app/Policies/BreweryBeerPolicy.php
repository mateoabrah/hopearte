<?php

namespace App\Policies;

use App\Models\Brewery;
use App\Models\User;

class BreweryBeerPolicy
{
    /**
     * Determina si el usuario puede gestionar las cervezas de la cervecería.
     */
    public function manageBeers(User $user, Brewery $brewery): bool
    {
        // Los administradores pueden gestionar cualquier cervecería
        if ($user->role === 'admin') {
            return true;
        }
        
        // Los usuarios de tipo company solo pueden gestionar sus propias cervecerías
        return $user->id === $brewery->user_id;
    }
}