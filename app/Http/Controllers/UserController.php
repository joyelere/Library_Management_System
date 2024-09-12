<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    // Retrieve a list of Users (Admins Only)
    public function index(Request $request)
    {
        // userAutorization check
        Gate::authorize('viewAny', User::class);

        $users = User::all();

        return response()->json($users);
    }


    // Retrieve a particular User by its ID (Admins Only)
    public function show($id)
    {

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        // userAutorization check
        Gate::authorize('view', $user);

        return response()->json($user);
    }


    // Update existing User (Admins and Self only)
    public function update(Request $request, User $user)
    {
        // userAutorization check
        Gate::authorize('update', $user);

        // Update User logic
        $userAttributes = $request->validate([
            'name' => 'required|max:255',
            'bio' => 'nullable',
            'birthdate' => 'nullable',
        ]);


        // Perform the update
        $user->update($userAttributes);

        // Return the updated User
        return response()->json($user);
    }

    // Delete a User (Admin only)
    public function destroy(User $user)
    {

        // userAutorization check
        Gate::authorize('delete', $user);

        // Delete the User
        $user->delete();

        // Return success response
        return response()->json([
            'message' => 'Deleted successfully',
        ], 200);
    }
}
