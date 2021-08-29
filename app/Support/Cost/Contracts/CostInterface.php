<?php


namespace App\Support\Cost\Contracts;


interface CostInterface
{
    public function getCost();

    public function getTotalCost();

    public function description();

    public function getSummary();
}
