<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'reg_no',
        'details',
        'amount',
        'reference',
        'status',
        'payment_id',
        'reciept_id',
    ];
}
