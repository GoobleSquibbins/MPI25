<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Book extends Model
{
    protected $fillable = [
        'name',
        'publisher_id',
        'year',
        'total_copies',
        'available_copies',
    ];

    public function authors()
    {
        return $this->belongsToMany(
            Author::class,
            'book_authors',
            'book_id',
            'author_id'
        );
    }

    public function genres()
    {
        return $this->belongsToMany(
            Genre::class,
            'book_genres',
            'book_id',
            'genre_id'
        );
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
