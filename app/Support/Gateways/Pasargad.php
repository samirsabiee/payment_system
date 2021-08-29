<?php


namespace App\Support\Gateways;


use App\Models\Order;
use App\Support\Gateways\Contracts\GatewayInterface;
use Illuminate\Http\Request;

class Pasargad implements GatewayInterface
{

    public function pay(Order $order)
    {
        dd($this->getName() . ' pay');
    }

    public function verify(Request $request)
    {
        // TODO: Implement verify() method.
    }

    public function getName(): string
    {
        return 'pasargad';
    }
}
