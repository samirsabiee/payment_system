<?php


namespace App\Support\Discount\Coupon\Validator;


use App\Exceptions\CouponHasExpiredException;
use App\Models\Coupon;

class IsExpired extends Contracts\AbstractCouponValidator
{
    /**
     * @throws CouponHasExpiredException
     */
    public function validate(Coupon $coupon): bool
    {
        if($coupon->isExpired()){
            throw new CouponHasExpiredException();
        }
        return parent::validate($coupon);
    }
}
