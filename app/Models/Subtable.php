<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtable extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'subject',
        'level',
        'department',
        'schedule',
        'created_at',
    ];
}
