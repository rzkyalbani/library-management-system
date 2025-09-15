<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'isbn',
        'publication_year',
        'category',
        'total_copies',
        'available_copies',
        'is_digital',
        'digital_url',
    ];
}
