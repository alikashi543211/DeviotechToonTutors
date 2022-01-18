@extends('layouts.student')
@section('title', 'Payment')
@section('css')
    <style>
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            height: 43px;
        }
        .StripeElement--invalid {
            border-color: #fa755a;
        }
        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
        #card-errors{
            color: #fa755a;
        }
    </style>
@endsection
@section('content')
<section class="dashboard-header" style="background-image: url({{ asset('theme/images/feather-long-bg.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2><span style="color: #f26d64;">Payment</span></h2>
                <h6>Add your payment details</h6>
            </div>
        </div>
    </div>
</section>
<section class="payment-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">Card details</h2>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        @if ($t_req->has_subscription)
                            <p class="font-weight-bold text-center">You don't have enough hours remaining <br> <a href="{{ route('student.packages') }}" class="text-primary">Click Here</a> to Buy Package </p>
                            <h2 class="text-center">OR</h2>
                        @endif
                        <p class="font-weight-bold text-center">Pay tutor fee of ${{ $rate }}</p>
                        <form action="{{ route('student.payment.save') }}" method="POST" id="payment-form" class=" text-center">
                            @csrf
                            <input id="card-holder-name" type="text" class="form-control" name="name" placeholder="Card Holder Name" autocomplete="off">
                            <div id="card-element" class="mt-3"></div>
                            <div id="card-errors" role="alert"></div>

                            <button type="submit" class="btn btn-default btn-medium mt-3" id="purchase-btn">
                                Payment
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>
@endsection
@section('js')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        $(document).ready(function () {
            // Create a Stripe client.
            var stripe = Stripe("{{ env('STRIPE_KEY') }}");

            // Create an instance of Elements.
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"proxima-nova", "Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                    color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {style: style, hidePostCode:true});

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            card.on('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            // Handle form submission.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                // Disable The submit button on click
                document.getElementById('purchase-btn').disabled = true;

                var options = {
                    name: document.getElementById('card-holder-name').value,
                }
                stripe.createToken(card, options).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                        // Enable The submit button
                        document.getElementById('purchase-btn').disabled = false;
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });
            });

            // Submit the form with the token ID.
            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }
        });
    </script>
@endsection
