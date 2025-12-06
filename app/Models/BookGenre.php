<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookGenre extends Model
{
    protected $fillable = [
        'book_id',
        'genre_id',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
