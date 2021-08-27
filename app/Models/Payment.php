<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'method', 'gateway', 'ref_num', 'amount', 'status'];
    protected $attributes = [
        'status' => 0,
    ];
}
