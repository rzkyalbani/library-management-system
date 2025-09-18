<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'member_id', 'book_id', 'reservation_date', 'exp_date', 'status'
    ];

    protected $casts = [
        'reservation_date' => 'datetime',
        'exp_date' => 'datetime'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
