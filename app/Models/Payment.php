<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'reg_no',
        'class',
        'term',
        'session',
        'type',
        'discount',
        'totalbills',
        'payableamount',
        'amountpaid',
        'credit',
    ];
}
