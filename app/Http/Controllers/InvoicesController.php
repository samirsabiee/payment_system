<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    /**
     * InvoicesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Order $order)
    {
        return $order->downloadInvoice();
    }
}
