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

    public function discountedPrice(Coupon $coupon, int $amount): int
    {
        return $amount - $this->discountAmount($coupon, $amount);
    }

    private function isExceeded($amount, $limit): bool
    {
        return $amount > $limit;
    }
}
