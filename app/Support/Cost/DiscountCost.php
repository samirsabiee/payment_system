<?php


namespace App\Support\Cost;


use App\Support\Cost\Contracts\CostInterface;
use App\Support\Discount\DiscountManager;

class DiscountCost implements Contracts\CostInterface
{
    private CostInterface $cost;
    private DiscountManager $discountManager;

    /**
     * DiscountCost constructor.
     * @param CostInterface $cost
     * @param DiscountManager $discountManager
     */
    public function __construct(CostInterface $cost, DiscountManager $discountManager)
    {
        $this->cost = $cost;
        $this->discountManager = $discountManager;
    }


    public function getCost(): int
    {
        return $this->discountManager->calculateUserDiscount();
    }

    public function getTotalCost(): int
    {
        return $this->cost->getTotalCost() - $this->getCost();
    }

    public function description(): string
    {
        return 'Discount';
    }

    public function getSummary(): array
    {
        return array_merge($this->cost->getSummary(), [
            $this->description() => $this->getCost(),
        ]);
    }
}
