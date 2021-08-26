<?php

namespace App\Http\Controllers;

use App\Exceptions\QuantityExceededException;
use App\Models\Product;
use App\Support\Basket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    private Basket $basket;

    /**
     * BasketController constructor.
     * @param Basket $basket
     */
    public function __construct(Basket $basket)
    {
        $this->basket = $basket;
    }

    public function add(Product $product): RedirectResponse
    {
        try {
            $this->basket->add($product, 1);
            return back()->with('success', true);
        } catch (QuantityExceededException $e) {
            return back()->with('failed', true);
        }
    }
}