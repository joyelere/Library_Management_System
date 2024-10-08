<?php

namespace App\Providers;

use App\Models\Book;
use App\Policies\BookPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gate::policy(Book::class, BookPolicy::class);
        // Gate::policy(User::class, UserPolicy::class);
        // Gate::policy(Author::class, AuthorPolicy::class);
        // Gate::policy(BorrowRecord::class, BorrowRecordPolicy::class);
    }
}
