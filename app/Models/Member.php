<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address', 'join_date'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'join_date' => 'datetime'
    ];
}

