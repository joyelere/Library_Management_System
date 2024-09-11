<?php

namespace App\Policies;

use App\Models\Author;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AuthorPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->role === 'Admin' || $user->role === 'Librarian';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Author $author)
    {
        return $user->role === 'Admin' || $user->role === 'Librarian';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Author $author)
    {
        return $user->role === 'Admin';
    }
}
