@extends('layouts.front')
@section('title', 'Success')
@section('content')
<div id="main"></div>

<section class="empower-section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <img src="{{ asset('theme/images/handshake.png') }}" class="img-fluid" alt="">
                <h1>Congratulations!</h1>
                <h4 class="text-dark">You have successfully connected your Google Calendar with our platform</h4>
                <p>Now you can check your class schedules on Google Calendar</p>
                @auth
                    @if (auth()->user()->role == "tutor")
                        <a href="{{ route('tutor.dashboard') }}" class="btn btn-default btn-square">Dashboard</a>
                    @elseif(auth()->user()->role == "parent")
                        <a href="{{ route('tutor.parent') }}" class="btn btn-default btn-square">Dashboard</a>
                    @elseif(auth()->user()->role == "student")
                        <a href="{{ route('tutor.student') }}" class="btn btn-default btn-square">Dashboard</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-default btn-square">Login</a>
                @endauth
            </div>
        </div>
    </div>
</section>



@include('front.components.callus')

@include('front.components.contact')

@endsection
