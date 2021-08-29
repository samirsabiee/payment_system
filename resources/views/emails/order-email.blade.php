<h4>thank you for shopping products</h4>
<h5>Details for {{ $order->id }} is: </h5>
<ul>
    @foreach($order->products as $product)
        <li>{{ $product->title }} Quantity : {{ $product->pivot->quantity }}</li>
    @endforeach
</ul>
