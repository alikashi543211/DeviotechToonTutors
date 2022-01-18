@extends('layouts.tutor')
@section('title', 'Dashboard')
@section('content')
<section class="tutor-dashboard-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Dashboard</h2>
                <h6>Welcome to the Tutor Dashboard</h6>
            </div>
        </div>
    </div>
</section>
<section class="pending-review mt-5 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <img src="{{ asset('theme/images/under-review.png') }}" width="128px" class="img-fluid" alt="">
                <h3 class="text-dark mt-3">Your Account is under review</h3>
                <p>Once it approved, you will receive an email</p>
            </div>
        </div>
    </div>
</section>
@endsection
