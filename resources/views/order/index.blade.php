@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Code</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Buy Date</th>
                <th>Operation</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->code }}</td>
                    <td>{{ $order->amount }}</td>
                    @if($order->paid())
                        <td>Paid</td>
                    @else
                        <td>Pending</td>
                    @endif
                    <td>{{ $order->created_at }}</td>
                    <td>
                        @if(!$order->paid())
                            <button class="btn btn-primary btn-sm">Pay</button>
                        @endif
                        <a href="{{ route('invoice.show', $order->id) }}" class="btn btn-primary btn-sm">Download
                            Invoice</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
