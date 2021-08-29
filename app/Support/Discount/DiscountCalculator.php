<?php


namespace App\Support\Discount;


use App\Models\Coupon;

class DiscountCalculator
{
    public function discountAmount(Coupon $coupon, int $amount)
    {
        $discountAmount = (int)(($coupon->percent / 100) * $amount);
        return $this->isExceeded($discountAmount, $coupon->limit)
            ? $coupon->limit
            : $discountAmount;
    }

    private function isExceeded($amount, $limit): bool
    {
        return $amount > $limit;
    }
}
