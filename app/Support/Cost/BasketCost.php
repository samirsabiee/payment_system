<?php


namespace App\Support\Cost;


use App\Support\Basket\Basket;

class BasketCost implements Contracts\CostInterface
{
    private Basket $basket;

    /**
     * BasketCost constructor.
     * @param Basket $basket
     */
    public function __construct(Basket $basket)
    {
        $this->basket = $basket;
    }


    public function getCost()
    {
        return $this->basket->subTotal();
    }

    public function getTotalCost()
    {
        return $this->getCost();
    }

    public function description(): string
    {
        return 'Total Cost';
    }

    public function getSummary(): array
    {
        return [$this->description() => $this->getTotalCost()];
    }
}
