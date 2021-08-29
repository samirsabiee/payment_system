<?php


namespace App\Support\Discount\Coupon;


use App\Exceptions\CouponHasExpiredException;
use App\Models\Coupon;
use App\Support\Discount\Coupon\Validator\CanUseIt;
use App\Support\Discount\Coupon\Validator\IsExpired;

class CouponValidator
{
    /**
     * @throws CouponHasExpiredException
     */
    public function isValid(Coupon $coupon)
    {
        $isExpired = resolve(IsExpired::class);
        $canUseIt = resolve(CanUseIt::class);

        $isExpired->setNextValidator($canUseIt);

        $isExpired->validate($coupon);

    }
}
