@extends('layouts.front')
@section('title', 'Success')
@section('content')
<div id="main"></div>

<section class="empower-section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <img src="{{ asset('theme/images/handshake.png') }}" class="img-fluid" alt="">
                <h1>THANK YOU!</h1>
                <h4 class="text-dark">You have successfully submitted your application to be a tutor</h4>
                <p>You will hear from us within four weeks if you are selected for an interview.</p>
                <a href="{{ route('login') }}" class="btn btn-default btn-square">Login</a>
            </div>
        </div>
    </div>
</section>



@include('front.components.callus')

@include('front.components.contact')

@endsection
