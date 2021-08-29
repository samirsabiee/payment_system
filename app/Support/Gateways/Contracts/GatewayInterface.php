<?php


namespace App\Support\Gateways\Contracts;


use App\Models\Order;
use Illuminate\Http\Request;

interface GatewayInterface
{
    public const TRANSACTION_FAILED = 'transaction.failed';
    public const TRANSACTION_SUCCESS = 'transaction.success';

    public function pay(Order $order);

    public function verify(Request $request);

    public function getName(): string;

}
