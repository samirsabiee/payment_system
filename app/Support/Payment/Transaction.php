<?php


namespace App\Support\Payment;


use App\Models\Order;
use App\Models\Payment;
use App\Support\Basket\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Transaction
{
    private Request $request;
    private Basket $basket;

    /**
     * Transaction constructor.
     * @param Request $request
     * @param Basket $basket
     */
    public function __construct(Request $request, Basket $basket)
    {
        $this->request = $request;
        $this->basket = $basket;
    }

    public function checkout()
    {

        $order = $this->makeOrder();

        $payment = $this->makePayment($order);

        $this->basket->clear();

        return $order;

    }

    public function makeOrder()
    {
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'amount' => $this->basket->subTotal() + Basket::TRANSPORT_COST,
            'code' => bin2hex(Str::random(64))
        ]);

        $order->products()->attach($this->products());

        return $order;
    }

    public function makePayment(Order $order)
    {
        return Payment::create([
            'order_id' => $order->id,
            'method' => ($this->request->only(['method']))['method'],
            'amount' => $order->amount
        ]);
    }

    public function products(): array
    {
        $products = [];
        foreach ($this->basket->all() as $item) {
            $products[$item->id] = ['quantity' => $item->quantity];
        }
        return $products;
    }


}
