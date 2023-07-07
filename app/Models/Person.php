<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $casts = [
        'birthday' => 'datetime',
    ];

    protected $fillable = [
        'name_english',
        'name_russian',
        'sex',
        'kinopoisk_id',
        'birthday',
    ];
}
