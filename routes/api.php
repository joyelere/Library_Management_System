<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowRecordController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {

    // Books and Authors Resource Routes (protected)
    Route::apiResource('books', BookController::class);
    Route::apiResource('authors', AuthorController::class);

    // User Resource Routes (Exclude 'store' method)
    Route::apiResource('users', UserController::class)->except(['store']);

    // BorrowRecord Resource Routes (Only 'index' and 'show' method)
    Route::apiResource('borrow-records', BorrowRecordController::class)->only(['index', 'show']);

    // Borrow and return book routes
    Route::post('/books/{book}/borrow', [BorrowRecordController::class, 'borrow']); // Borrow a book
    Route::post('/books/{book}/return', [BorrowRecordController::class, 'return']); // Return a book

    // Logout Route
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Public Routes (No authentication required)
Route::post('/users', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
