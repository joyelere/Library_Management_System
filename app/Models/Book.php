<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'isbn',
        'published_date',
        'author_id',
        'status',
    ];

    
    // A book belongs to an author.
     
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    
    // A book can have many borrow records.
    
    public function borrowRecords()
    {
        return $this->hasMany(BorrowRecord::class);
    }
}
