<?php


namespace App\Support\Discount;


use App\Support\Cost\BasketCost;

class DiscountManager
{
    private BasketCost $basketCost;
    private DiscountCalculator $discountCalculator;

    /**
     * DiscountManager constructor.
     * @param BasketCost $basketCost
     * @param DiscountCalculator $discountCalculator
     */
    public function __construct(BasketCost $basketCost, DiscountCalculator $discountCalculator)
    {
        $this->basketCost = $basketCost;
        $this->discountCalculator = $discountCalculator;
    }


    public function calculateUserDiscount(): int
    {
        if (!session()->has('coupon')) return 0;
        return $this->discountCalculator->discountAmount(session()->get('coupon'), $this->basketCost->getTotalCost());
    }

}
