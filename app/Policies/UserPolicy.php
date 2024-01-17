<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\Response;

class UserPolicy
{

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        $a = Role::find($user->role_id);
        $arrayPer = str_split($a->permission);
        return in_array(2, $arrayPer);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $a = Role::find($user->role_id);
        $arrayPer = str_split($a->permission);
        return in_array(1, $arrayPer);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        $a = Role::find($user->role_id);
        $arrayPer = str_split($a->permission);
        return in_array(3, $arrayPer);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        $a = Role::find($user->role_id);
        $arrayPer = str_split($a->permission);
        return in_array(4, $arrayPer);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
