@extends('layouts.front')
@section('title', 'Book by hours')
@section('css')
<style type="text/css">
    .holder-name {
        padding: 8px 15px !important;
    }
    .error {
        color: red;
    }
</style>
@endsection
@section('content')
<section class="page-hero-section" style="background-image: url({{ asset('theme/images/services.jpg') }});">
    <div class="page-hero-text-wrapper">
        <h2>{{ $package->name }}</h2>
    </div>
    <a href="#main" class="angle-scrolldown"><i class="fa fa-angle-down"></i></a>
</section>
<div id="main"></div>
<section class="person-tutoring-section">
    <div class="container">
        <div class="services-heading-area">
            <h2>Online and In Person Tutoring</h2>
            <h4>K-12</h4>
            <h3>Starts from $35 per hour</h3>
        </div>
    </div>
</section>

{{-- <section class="request-free-consultation">
    <div class="container text-center">
        <div class="row">
            <div class="col-12">
                <h2>Request a Free Consultation</h2>
            </div>
        </div>
    </div>
</section> --}}

<section class="book-consultation" style="background-image: url({{ asset('theme/images/feather-long-bg.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="consultant-form">
                    <h2>Let's Get <span style="color: #f26d64;">Started</span></h2>
                    {{-- <p>We want you to have the opportunity to sit down with us, get to know what we’re all about, and how we can meet
                    your specific needs. To book a free consultation, please fill out the information below.</p> --}}
                    <div class="mt-5"></div>
                    <form action="{{ Auth::User()->role == 'student' ? route('student.book.by.hour') : route('parent.book.by.hour') }}" method="POST" id="payment-form">
                        @csrf
                        <div class="form-group">
                            <label for="parent_name">Enter Quantity:</label>
                            <input type="number" name="quantity" size="191" id="quantity" class="form-control @error('quantity') is-invalid @enderror" value="1" required="" min="1">
                            <label class="error d-none">Quantity Should be greater than 0.</label>
                            <label class="hour-error error d-none">Quantity Should be greater than your selecting hours for session.</label>
                            @error('quantity')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <input type="hidden" name="total_amount" value="{{ $package->total_amount }}">
                        <input type="hidden" name="minimum_hour" value="{{ $package->minimum_hour }}">
                        <input type="hidden" name="package_type" value="{{ $package->type }}">
                        <div class="checkout_form group">
                            <div class="card_number mb-4" id="card-container">
                                <input type="text" class="input field w-100 pt-0 holder-name form-control" placeholder="Card holder name" name="name" id="name" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <div id="card-element" class="field mb-5"></div>
                                <div class="text-danger mt-3" id="card-errors" role="alert"></div>
                            </div>
                            <div id='submit'>
                                <button type="submit" class="btn btn-dark btn-lg btn-block text-uppercase font-weight-bold payment-buttons" id="purchase-btn"> Proceed for booking </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>
@php
$session = '';
if (session('request_tutor')) {
    $session = session('request_tutor');
    // dd($session);
    $should_buy_hour = $session->should_buy_hour;
}
@endphp

@include('front.components.callus')

@include('front.components.contact')

@endsection
@section('js')
<script src="https://js.stripe.com/v3/"></script>
<script>
    $(document).ready(function () {
        var stripe = Stripe("{{ env('STRIPE_KEY') }}");
        var elements = stripe.elements();
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

        var card = elements.create('card', {style: style, hidePostCode:true});

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
        var package_minimum_hour = '{{ $package->minimum_hour }}';
        var session = '{{ $session->message ?? ''}}';
        var should_buy_hour = "";
        if (session != '') {
            var should_buy_hour = '{{ $should_buy_hour }}';
        }
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            if ($('#quantity').val() <= 0) {
                $('.error').removeClass('d-none');
                return false;
            }else {
                $('.error').addClass('d-none');
            }
            if (package_minimum_hour  == "1") {
                if (should_buy_hour != '' && $('#quantity').val() < should_buy_hour) {
                    $('.hour-error').removeClass('d-none');
                    return false;
                }else {
                    $('.hour-error').addClass('d-none');
                }
            }else {
                var total_package_hour = package_minimum_hour * $('#quantity').val();
                if (should_buy_hour != '' && total_package_hour < should_buy_hour) {
                    console.log(should_buy_hour);
                    $('.hour-error').removeClass('d-none');
                    return false;
                }else {
                    $('.hour-error').addClass('d-none');
                }
            }
            

            // Disable The submit button on click
            document.getElementById('purchase-btn').disabled = true;

            var options = {
                name: document.getElementById('name').value,
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
