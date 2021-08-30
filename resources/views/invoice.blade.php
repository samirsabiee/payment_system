@inject('cost','App\Support\Cost\Contracts\CostInterface')
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>A4 Invoice</title>
    <style>
        @page {
            header: page-header;
            footer: page-footer;
        }

        body {
            font-family: sans-serif;
        }

        #invoice {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #invoice td, #invoice th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #invoice tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #invoice tr:hover {
            background-color: #ddd;
        }

        #invoice th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>
<body>
<htmlpageheader name="page-header">
    Your Header Content
</htmlpageheader>
<div>
    <table id="invoice">
        <thead>
        <tr>
            <th>Title</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->products as $product)
            <tr>
                <td>{{ $product->title }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>{{ $product->price * $product->pivot->quantity }}</td>
            </tr>
        @endforeach
        @foreach($cost->getsummary() as $description => $price)
            <tr>
                <td colspan="3">{{ $description }}</td>
                <td>{{ $price }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">Total Pay</td>
            <td>{{ $cost->getTotalCost() }}</td>
        </tr>
        </tbody>
    </table>
</div>
<htmlpagefooter name="page-footer">
    Your Footer Content
</htmlpagefooter>
</body>
</html>
