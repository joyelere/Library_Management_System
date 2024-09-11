<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BorrowRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BorrowRecordController extends Controller
{
    // GET /borrow-records: Retrieve all borrow records (Admin/Librarian only)
    public function index()
    {
        Gate::authorize('viewAny', BorrowRecord::class);

        // Retrieve all borrow records with pagination
        $borrowRecords = BorrowRecord::with(['user', 'book'])->paginate(10);
        return response()->json($borrowRecords, 200);
    }


    public function show($id)
    {
        // Authorization check before fetching the record
        // Ensure the current user is authorized to view any borrow record
        Gate::authorize('view', BorrowRecord::class);

        // Fetch the borrow record with associated user and book
        $borrowRecord = BorrowRecord::with(['user', 'book'])->find($id);

        // Check if the borrow record exists
        if (!$borrowRecord) {
            return response()->json(['message' => 'Borrow record not found.'], 404);
        }

        // Return the record if authorized
        return response()->json($borrowRecord, 200);
    }


    public function borrow(Request $request, Book $book)
    {
        // Validate the request
        $request->validate([
            'days' => 'required|integer|min:1|max:14' // Ensure days is between 1 and 14
        ]);

        // Check authorization
        Gate::authorize('borrow', BorrowRecord::class);

        // Check if the book is already borrowed
        $existingRecord = BorrowRecord::where('book_id', $book->id)
            ->whereNull('returned_at')
            ->first();

        if ($existingRecord) {
            return response()->json(['message' => 'Book is already borrowed.'], 400);
        }

        // Calculate the due date
        $dueAt = now()->addDays($request->input('days'));

        // Create a new borrow record
        $borrowRecord = new BorrowRecord();
        $borrowRecord->user_id = Auth::id(); // Current authenticated user ID
        $borrowRecord->book_id = $book->id;
        $borrowRecord->borrowed_at = now(); // Current timestamp
        $borrowRecord->due_at = $dueAt; // Due date based on the number of days
        $borrowRecord->save();

        // Update book status to 'Borrowed'
        $book->status = 'Borrowed';
        $book->save();

        return response()->json(['message' => 'Book borrowed successfully.'], 201);
    }



    public function return(Book $book)
    {
        // Find the borrow record for the current user and book
        $borrowRecord = BorrowRecord::where('book_id', $book->id)
            ->where('user_id', Auth::id())
            ->whereNull('returned_at')
            ->first();

        if (!$borrowRecord) {
            return response()->json(['message' => 'No record found for this borrowed book.'], 404);
        }

        // Check authorization for return
        Gate::authorize('return', $borrowRecord);

        // Update the borrow record with return details
        $borrowRecord->returned_at = now(); // Current timestamp
        $borrowRecord->save();

        // Update book status to 'Available'
        $book->status = 'Available';
        $book->save();

        return response()->json(['message' => 'Book returned successfully.'], 200);
    }
}
