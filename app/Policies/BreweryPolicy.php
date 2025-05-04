<?php

namespace App\Policies;

use App\Models\Brewery;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BreweryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Brewery  $brewery
     * @return mixed
     */
    public function update(User $user, Brewery $brewery)
    {
        return $user->id === $brewery->user_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Brewery  $brewery
     * @return mixed
     */
    public function delete(User $user, Brewery $brewery)
    {
        return $user->role === 'admin';
    }
}