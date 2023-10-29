@extends('layouts.default', [
    'currentCategory' => $category->name
])
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Profile')

@section('content')
    <div class="products">
        <div>
            @if (Session::get('success'))
                <div class="alert alert-success text-center">
                    {{ Session::get('success') }}
                </div>
            @endif

            <div class="d-flex justify-content-between pt-3 bg-white mb-3 align-items-center">
                <span class="font-weight-bold text-uppercase">{{ $category->name }}</span>
            </div>

            <p class="text-muted">
                {{ $category->products->count() }} {{ Str::plural('item', $category->products->count()) }}
            </p>

            <div class="row g-3">
                @foreach ($category->products as $product)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ $product->picture }}" class="card-img-top" height="300">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    {{-- Item Name --}}
                                    <span class="font-weight-bold">
                                        {{ $product->name }}
                                    </span>
                                    {{-- formatted price --}}
                                    <span class="font-weight-bold">{{ $product->formatted_price }}</span>
                                </div>
                                <small class="text-muted">
                                    {{ $product->quantity }} {{ Str::plural('item', $product->quantity) }} in stock
                                </small>
                                <p class="card-text mb-1 mt-1">{{ $product->short_description }}</p>

                                <div class="d-flex align-items-center flex-row">
                                    <img src="https://i.imgur.com/e9VnSng.png" width="20">
                                    <span class="guarantee">
                                        @if ($product->guarantee)
                                            @if ($product->guarantee > 12)
                                                {{ floor($product->guarantee / 12) }} Years Guarantee
                                            @elseif ($product->guarantee < 12)
                                                {{ $product->guarantee }} Months Guarantee
                                            @endif
                                        @else
                                            No Guarantee
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="text-right buttons">
                                    <a class="btn btn-outline-dark" href="{{ route('category.product', ['product' => $product->id] ) }}">View details</a>
                                    @if($product->quantity > 0)
                                        <a class="btn btn-dark" href="{{ route('category.product', ['product' => $product->id, 'status' => 'checkout'] ) }}">Checkout</a>
                                    @else
                                        <a class="btn btn-secondary disabled">
                                            <del>Checkout</del>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
