<?php

namespace App\Http\Controllers;

use App\Exceptions\QuantityExceededException;
use App\Http\Requests\CheckoutRequest;
use App\Models\Product;
use App\Support\Basket\Basket;
use App\Support\Payment\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    private Basket $basket;
    private Transaction $transaction;

    /**
     * BasketController constructor.
     * @param Basket $basket
     * @param Transaction $transaction
     */
    public function __construct(Basket $basket, Transaction $transaction)
    {
        $this->middleware('auth')->only(['checkoutForm', 'checkout']);
        $this->basket = $basket;
        $this->transaction = $transaction;
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

    public function checkout(CheckoutRequest $request): RedirectResponse
    {
        $order = $this->transaction->checkout();
        return redirect()->route('home')->with('successOrder', __('payment.success payment', ['orderNum' => $order->id]));
    }
}
