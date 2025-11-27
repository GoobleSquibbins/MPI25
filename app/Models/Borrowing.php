<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $fillable = [
        'member_id',
        'staff_id',
        'borrow_date',
        'due_date',
        'return_date',
        'status'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
