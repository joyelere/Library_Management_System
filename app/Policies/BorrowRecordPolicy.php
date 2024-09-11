<?php

namespace App\Policies;

use App\Models\BorrowRecord;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BorrowRecordPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->role === 'Admin' || $user->role === 'Librarian';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model)
    {
        return $user->role === 'Admin' || $user->role === 'Librarian';
    }

    public function borrow(User $user)
    {
        return $user->role === 'Member';
    }

    public function return(User $user, BorrowRecord $borrowRecord)
    {
        return $user->role === 'Member' && $borrowRecord->user_id === $user->id;
    }
}
