<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    public function before(?User $user, $ability)
    {
        if ($user?->is_admin
            /** && $ability === 'update' */
        ) return true;
    }


    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function viewMySongs(User $user): bool
    {
        return Auth::user()->id === $user?->id;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, User $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function create(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $model->id === $user?->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $model->id === $user?->id;
    }
}
