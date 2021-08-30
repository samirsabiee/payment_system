<?php


namespace App\Support\Discount\Coupon\Traits;


use App\Models\Coupon;
use Illuminate\Support\Carbon;

trait CouponAble
{
    public function coupons()
    {
        return $this->morphMany(Coupon::class, 'couponable');
    }

    public function validCoupons()
    {
        return $this->coupons()->where('expire_time', '>', Carbon::now());
    }
}
