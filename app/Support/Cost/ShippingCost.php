<?php


namespace App\Support\Cost;


use App\Support\Cost\Contracts\CostInterface;

class ShippingCost implements Contracts\CostInterface
{
    const SHIPPING_COST = 20;
    private CostInterface $cost;

    public function __construct(CostInterface $cost)
    {
        $this->cost = $cost;
    }

    public function getCost(): int
    {
        return self::SHIPPING_COST;
    }

    public function getTotalCost(): int
    {
        return $this->cost->getTotalCost() + $this->getCost();
    }

    public function description(): string
    {
        return 'Transport Cost';
    }

    public function getSummary(): array
    {
        return array_merge($this->cost->getSummary(),[
            $this->description() => $this->getCost()
        ]);
    }
}
