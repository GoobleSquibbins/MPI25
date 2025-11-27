<?php

namespace App\Models;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Staff extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'name',
        'password',
        'role_id',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
