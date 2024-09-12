<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
{
    // Retrieve a list of Authors
    public function index()
    {
        $authors = Author::paginate(10);

        return response()->json($authors);
    }


    // Retrieve a particular Author by its ID
    public function show($id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json(['message' => 'Author not found.'], 404);
        }

        return response()->json($author);
    }

    // Store new Author (Admins and Librarians only)
    public function store(Request $request)
    {
        // Authorization check
        Gate::authorize('create', Author::class);

        // Store Author logic
        $authorAttributes = $request->validate([
            'name' => 'required|max:255',
            'bio' => 'nullable',
            'birthdate' => 'nullable',
        ]);

        $author = Author::create($authorAttributes);
        return response()->json($author, 201);
    }

    // Update existing Author (Admins and Librarians only)
    public function update(Request $request, Author $author)
    {
        // Authorization check
        Gate::authorize('update', $author);

        // Update Author logic
        $authorAttributes = $request->validate([
            'name' => 'required|max:255',
            'bio' => 'nullable',
            'birthdate' => 'nullable',
        ]);


        // Perform the update
        $author->update($authorAttributes);

        // Return the updated author
        return response()->json($author);
    }

    // Delete a Author (Admin only)
    public function destroy(Author $author)
    {

        // Authorization check
        Gate::authorize('delete', $author);

        // Delete the author
        $author->delete();

        // Return success response
        return response()->json([
            'message' => 'Deleted successfully',
        ], 200);
    }
}
