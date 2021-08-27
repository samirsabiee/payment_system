<?php

namespace App\Http\Controllers;

use App\Exceptions\QuantityExceededException;
use App\Http\Requests\CheckoutRequest;
use App\Models\Product;
use App\Support\Basket\Basket;
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
        $this->middleware('auth')->only(['checkoutForm', 'checkout']);
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

    public function index()
    {
        $products = $this->basket->all();
        return view('basket', compact('products'));
    }

    /**
     * @throws QuantityExceededException
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $this->basket->update($product, $request->quantity);
        return back();
    }

    public function checkoutForm()
    {
        return view('checkout');
    }

    public function checkout(CheckoutRequest $request)
    {
        dd($request->all());
    }
}
