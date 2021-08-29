<?php


namespace App\Support\Payment;


use App\Events\OrderRegistered;
use App\Models\Order;
use App\Models\Payment;
use App\Support\Basket\Basket;
use App\Support\Cost\Contracts\CostInterface;
use App\Support\Gateways\Contracts\GatewayInterface;
use App\Support\Gateways\Pasargad;
use App\Support\Gateways\Saman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Transaction
{

    private Request $request;
    private Basket $basket;
    private CostInterface $cost;

    /**
     * Transaction constructor.
     * @param Request $request
     * @param Basket $basket
     * @param CostInterface $cost
     */
    public function __construct(Request $request, Basket $basket, CostInterface $cost)
    {
        $this->request = $request;
        $this->basket = $basket;
        $this->cost = $cost;
    }

    public function checkout()
    {
        DB::beginTransaction();

        try {
            $order = $this->makeOrder();

            $payment = $this->makePayment($order);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }

        if ($payment->isOnline()) {
            /*TODO use return to redirect to bank page*/
            return $this->gatewayFactory()->pay($order, $this->cost->getTotalCost());
        }

        $this->normalizeQuantity($order);

        event(new OrderRegistered($order));

        $this->basket->clear();

        return $order;

    }

    private function gatewayFactory()
    {
        $gateway = [
            'saman' => Saman::class,
            'pasargad' => Pasargad::class
        ][$this->request->gateway];

        return resolve($gateway);
    }

    public function makeOrder()
    {
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'amount' => $this->basket->subTotal(),
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
            'amount' => $this->cost->getTotalCost()
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

    public function verify(): bool
    {
        $result = $this->gatewayFactory()->verify($this->request);
        if ($result['status'] === GatewayInterface::TRANSACTION_FAILED) return false;
        return true;
    }

    public function normalizeQuantity($order)
    {
        foreach ($order->products()->get() as $product) {
            $product->decrementStock($product->pivot->quantity);
        }
    }


}
