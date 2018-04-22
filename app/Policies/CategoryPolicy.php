<?php

namespace App\Policies;

use App\{User, Category};
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the category.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->role === User::AUTHOR_ROLE;
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return false;
    }
}
