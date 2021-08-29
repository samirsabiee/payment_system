<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Coupon extends Model
{
    use HasFactory;

    public function isExpired(): bool
    {
        return Carbon::now()->isAfter(Carbon::parse($this->expire_time));
    }
}
