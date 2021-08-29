<form method="post" id="samanpayment" action="https://sep.shaparak.ir/payment.aspx">
    <input type="hidden" name="Amount" value="{{ $order->amount }}">
    <input type="hidden" name="ResNum" value="{{ $order->code }}">
    <input type="hidden" name="RedirectURL" value="{{ $merchantID }}">
    <input type="hidden" name="MID" value="{{ $callback }}">
</form>
<script>document.forms['samanpayment'].submit()</script>
