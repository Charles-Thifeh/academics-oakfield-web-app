<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pryre extends Model
{
    use HasFactory;

    protected $fillable = [
        'reg_no',
        'class',
        'term',
        'session',
        'subject',
        'mt',
        'ex',
        'ts',
        'uploaded_by',
        'created_at',
    ];
}
