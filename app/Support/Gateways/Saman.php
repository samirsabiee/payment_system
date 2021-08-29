<?php


namespace App\Support\Gateways;


use App\Http\Controllers\PaymentController;
use App\Models\Order;

use App\Support\Gateways\Contracts\GatewayInterface;
use Illuminate\Http\Request;

class Saman implements GatewayInterface
{
    private string $merchantID;
    private string $callback;

    /**
     * Saman constructor.
     */
    public function __construct()
    {
        $this->merchantID = '253614548';
        $this->callback = route('payment.verify', $this->getName());
    }


    public function pay(Order $order)
    {
        //$this->redirectToBank($order);
        resolve(PaymentController::class)->verify([
            'State' => null,
            'StateCode' => null,
            'ResNum' => $order->code,
            'MID' => $this->merchantID,
            'RefNum' => null,
            'CID' => null,
            'TRACENO' => null,
            'RNN' => null,
            'SecurePan' => null
        ]);
    }

    private function redirectToBank($order)
    {
        echo "<form method='post' id='samanpayment' action='https://sep.shaparak.ir/payment.aspx'>
                <input type='hidden' name='Amount' value='{ $order->amount }'>
                <input type='hidden' name='ResNum' value='{ $order->code }'>
                <input type='hidden' name='TerminalId' value='{ $this->merchantID }'>
                <input type='hidden' name='RedirectURL' value='{ $this->callback }'>
                <input type='hidden' name='CellNumber' value='09362633788'>
            </form>
            <script>document.forms['samanpayment'].submit()</script>";
    }

    public function verify(Request $request): array
    {
        if (!$request->has('State') || $request->input('State') !== 'OK') {
            return $this->transactionFailed();
        }
    }

    public function transactionFailed(): array
    {
        return [
            'status' => self::TRANSACTION_FAILED,
        ];
    }

    public function getName(): string
    {
        return 'saman';
    }
}
