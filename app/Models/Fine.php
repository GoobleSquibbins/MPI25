<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    protected $fillable = [
        'borrow_id',
        'amount',
        'status',
    ];

    public function borrow()
    {
        return $this->belongsTo(Borrowing::class, 'borrow_id');
    }
}
