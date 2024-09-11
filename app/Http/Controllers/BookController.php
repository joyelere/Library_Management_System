<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    // Retrieve a paginated list of books with search
    public function index(Request $request)
    {
        $search = $request->input('search', ''); // Default to empty string if no search term
        $perPage = $request->input('per_page', 10); // Default to 10 items per page

        $books = Book::where('title', 'like', "%{$search}%")
            ->orWhere('author', 'like', "%{$search}%")
            ->orWhere('isbn', 'like', "%{$search}%")
            ->paginate($perPage); // Paginate results based on per_page parameter

        return response()->json($books);
    }


    // Retrieve a particular book by its ID
    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found.'], 404);
        }

        return response()->json($book);
    }

    // Store new book (Admins and Librarians only)
    public function store(Request $request)
    {

        // Authorization check
        Gate::authorize('create', Book::class);

        // Store book logic

        $bookAttributes = $request->validate([
            'title' => 'required|max:255',
            'isbn' => 'required|max:13|unique:books,isbn',
            'published_date' => 'nullable|date',
            'author_id' => 'required|exists:authors,id',
        ]);

        $book = Book::create($bookAttributes);
        return response()->json($book, 201);
    }

    // Update existing book (Admins and Librarians only)
    public function update(Request $request, Book $book)
    {
        // Authorization check
        Gate::authorize('update', $book);

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'isbn' => 'required|string|max:13|unique:books,isbn,' . $book->id,
            'published_date' => 'nullable|date',
            'author_id' => 'required|exists:authors,id',
            'status' => ['required', Rule::in(['Available', 'Borrowed'])],
        ]);

        $book->update($validatedData);

        return response()->json($book, 201);
    }

    // Delete a book (Admin only)
    public function destroy(Book $book)
    {
        // Authorization check
        Gate::authorize('delete', $book);

        // Delete the author
        $book->delete();

        // Return success response
        return response()->json([
            'message' => 'Book Deleted successfully',
        ], 200);
    }
}
