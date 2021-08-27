@extends('layouts.app')

@section('content')
    <div class="d-flex flex-row">
        <div class="col-9">
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
                </thead>
                <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->price . '$' }}</td>
                        <td>{{ $product->quantity }}</td>
                    </tr>
                @empty
                    <p class="text-center font-weight-bolder m-3">Basket is empty click and go to <a href="{{ route('products.index') }}">products</a> page</p>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-3">
            @include('summary')
        </div>
    </div>
@endsection
