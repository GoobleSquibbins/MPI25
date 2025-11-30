<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowingDetail extends Model
{
    protected $fillable = [
        'borrow_id',
        'book_id',
        'qty'
    ];

    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class, 'borrow_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
