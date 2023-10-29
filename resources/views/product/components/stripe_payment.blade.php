
<div class="card d-none" id="payment-wrapper">
    <form id="checkout-form" action="{{ route('category.product.checkout', ['product' => $product->id]) }}" method="POST">
        @csrf

        <div class="card-body">
            <div class="col-12">
                <div class="col-12 col-md-12">
                    <div class="form-group mb-1">
                            <label for="stripe-name" class="col-form-label pb-0">Name:</label>

                            <input id="stripe-name"
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name')}}"
                                required
                            >
                    </div>
                </div>

                <div class="col-12 col-md-12">
                    <div class="form-group mb-1">
                        <label for="stripe-email" class="col-form-label pb-0">Email:</label>

                        <input id="stripe-email"
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email')}}"
                            required
                        >
                    </div>
                </div>

                <div class="col-12 col-md-12">
                    <div class="form-group">
                        <label for="card-element">Card</label>
                        <div id="card-element" class="form-control"></div>

                        <div id="card-errors" class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="text-right buttons">
                <button type="button" class="btn btn-outline-dark" id="cancel-checkout">Cancel</button>
                <button type="submit" class="btn btn-dark" id="pay-item">Pay {{ $product->formatted_price }}</button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        var checkoutForm = document.getElementById('checkout-form');
        var btnPayItem = document.getElementById('pay-item');
        var btnCancelCheckout = document.getElementById('cancel-checkout');
        var cardElementWrapper = null;

        btnCancelCheckout.addEventListener('click', function(event) {
            event.preventDefault();

            document.getElementById('item-details-buttons').classList.remove('d-none');
            document.getElementById('payment-wrapper').classList.add('d-none');
        });

        checkoutForm.addEventListener('submit', function(event) {
            event.preventDefault();

            btnPayItem.setAttribute('disabled', true);
            btnCancelCheckout.setAttribute('disabled', true);

            stripe.createToken(cardElementWrapper).then(function(result) {
                if (result.error) {
                    showNotice('error', result.error.message)
                    return
                }

                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripe_token');
                hiddenInput.setAttribute('value', result.token.id);

                checkoutForm.appendChild(hiddenInput);

                checkoutForm.submit();
            });
        });

        function stripeInit() {
            stripe = Stripe("{{ config('services.stripe.key') }}");
            elements = stripe.elements();
            cardElementWrapper = elements.create('card');

            cardElementWrapper.mount('#card-element');
            cardElementWrapper.clear();

            cardElementWrapper.on('change', function(event) {
                var displayError = document.getElementById('card-errors');
                var cardElement = document.getElementById('card-element');

                if (event.error) {
                    displayError.textContent = event.error.message;
                    cardElement.classList.add('is-invalid');

                    btnPayItem.setAttribute('disabled', true);
                    btnCancelCheckout.setAttribute('disabled', true);
                } else {
                    displayError.textContent = '';
                    cardElement.classList.remove('is-invalid');

                    btnPayItem.removeAttribute('disabled');
                    btnCancelCheckout.removeAttribute('disabled');
                }
            });
        };
    </script>
@endpush
