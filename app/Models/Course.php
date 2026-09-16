<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'day',
        'start_time',
        'end_time',
        'audience',
        'category',
        'city',
        'venue',
        'room',
        'notes',
        'is_active',
    ];
}