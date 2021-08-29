<?php

namespace App\Http\Controllers;

use App\Support\Payment\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private Transaction $transaction;

    /**
     * PaymentController constructor.
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function verify($array): RedirectResponse
    {
        return $this->transaction->verify()
            ? $this->sendSuccessResponse()
            : $this->sendFailedResponse();
    }

    public function sendFailedResponse(): RedirectResponse
    {
        return redirect()->route('home')->with('failed', true);
    }

    public function sendSuccessResponse(): RedirectResponse
    {
        return redirect()->route('home')->with('success', true);
    }
}
