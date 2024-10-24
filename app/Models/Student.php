<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'surname',
        'firstname',
        'reg_no',
        'class',
        'department',
        'password',
        'status',
        'created_at',
    ];
}
