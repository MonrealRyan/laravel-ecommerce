@extends('layouts.default', [
    'currentCategory' => $product->category->name
])
@section('pageTitle', $product->name . " Checkout")

@section('content')
    <div class="container">
        <div>

            <div class="row g-3 justify-content-center">
                <div class="d-flex justify-content-center pt-3 bg-white mb-3 align-items-center">
                    <h2 class="font-weight-bold text-uppercase">Product Checkout</h2>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ $product->picture }}" class="card-img-top" height="300">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            @if (Session::get('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                            @endif

                            @if (sizeof($errors->all()))
                                <div class="alert alert-danger">
                                    Please check the list of error below:
                                    <ul>
                                        @foreach ($errors->all() as $message)
                                            <li>
                                                {{ $message }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="d-flex justify-content-between">
                                {{-- Item Name --}}
                                <span class="font-weight-bold">{{ $product->name }}</span>
                                <small class="text-muted">
                                    {{ $product->quantity }} {{ Str::plural('item', $product->quantity) }} in stock
                                </small>
                            </div>
                            <p class="card-text mb-1 mt-1">
                                <span class="font-weight-bold">Description: </span>
                                {{ $product->long_description }}
                            </p>

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
                        @if ($product->quantity > 0)
                            <div class="card-body" id="item-details-buttons">
                                <div class="text-right buttons">
                                    <a class="btn btn-dark" id="checkout-item">Checkout for {{ $product->formatted_price }}</a>
                                </div>
                            </div>

                            @include('product.components.stripe_payment')
                        @else
                            <p class="text-muted text-center font-weight-bold">No stocks available</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @if ($product->quantity > 0)
        <script>
            var btnCheckoutItem = document.getElementById('checkout-item');
            var showPaymentForm = function() {
                document.getElementById('item-details-buttons').classList.add('d-none');
                document.getElementById('payment-wrapper').classList.remove('d-none');
                document.getElementById('stripe-name').focus();

                setTimeout(function() {
                    stripeInit();
                }, 100);
            }

            @if (Session::get('error') || sizeof($errors->all()) || (request()->has('status') && in_array(request('status'), ['failed', 'checkout'])))
                {{-- trigger --}}
                showPaymentForm();
            @endif


            btnCheckoutItem.addEventListener('click', function() {
                showPaymentForm()
            });
        </script>
    @endif
@endpush
