@extends('layouts.app')

@section('content')
    <div class="row d-flex flex-row justify-content-around">
        @forelse($products as $product)
            <div class="card col-2 p-0 m-1">
                <img src="{{ $product->image }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->title }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <a href="{{ route('basket.add', $product->id) }}" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        @empty
            <h6 class="text-center">No Product Exist!</h6>
        @endforelse
    </div>
@endsection
