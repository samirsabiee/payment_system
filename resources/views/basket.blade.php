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
                        <td class="col-4">{{ $product->title }}</td>
                        <td class="col-4">{{ $product->price . '$' }}</td>
                        <td class="col-4">
                            <form method="post" action="{{ route('basket.update', $product->id) }}">
                                @csrf
                                <div class="input-group">
                                    <select class="custom-select" id="quantity" name="quantity"
                                            aria-label="Quantity Product">
                                        <option value="0">0</option>
                                        @for($i = 1; $i <= $product->stock; $i++)
                                            <option
                                                {{ $i == $product->quantity ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit"> Update</button>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                @empty
                    <p class="text-center font-weight-bolder m-3">Basket is empty click and go to <a
                            href="{{ route('products.index') }}">products</a> page</p>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-3">
            @include('summary')
            <a href="{{ route('basket.checkout.form') }}" class="btn btn-primary btn-block mt-4">Continue To pay</a>
        </div>
    </div>
@endsection
