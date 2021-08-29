<?php


namespace App\Support\Discount\Coupon\Validator\Contracts;


use App\Models\Coupon;

abstract class AbstractCouponValidator implements CouponValidatorInterface
{
    private $nextValidator;

    public function setNextValidator(CouponValidatorInterface $validator)
    {
        $this->nextValidator = $validator;
    }

    public function validate(Coupon $coupon): bool
    {
        if ($this->nextValidator === null) {
            return true;
        }

        return $this->nextValidator->validate($coupon);
    }
}
