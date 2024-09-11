<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookPolicy
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
    public function update(User $user, Book $book)
    {
        return $user->role === 'Admin' || $user->role === 'Librarian';

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Book $book)
    {
        return $user->role === 'Admin';
    }

}
