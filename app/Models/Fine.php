<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    protected $fillable = ['borrow_id', 'amount', 'fine_date', 'is_paid'];

    protected $casts = [
        'fine_date' => 'datetime',
    ];

    public function borrow()
    {
        return $this->belongsTo(Borrow::class);
    }
}
