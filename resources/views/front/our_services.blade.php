@extends('layouts.front')
@section('title', 'Our Services')
@section('css')
    <style>
        .packages-section .section-heading{
            font-size: 38px;
        }
    </style>
@endsection
@section('content')
<section class="page-hero-section" style="background-image: url({{ asset('theme/images/services.jpg') }});">
    <div class="page-hero-text-wrapper">
        <h2>Our Services</h2>
    </div>
    <a href="#main" class="angle-scrolldown"><i class="fa fa-angle-down"></i></a>
</section>
<div id="main"></div>
<section class="person-tutoring-section">
    <div class="container">
        <div class="services-heading-area">
            <h2>Virtual One on One Tutoring</h2>
            <h4>K-12</h4>
            <h3>All Subjects</h3>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 mb-5">
                <div class="card card-services">
                    <div class="card-image">
                        <img src="{{ asset('theme/images/small-4.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="card-body">
                        <h5>Mathematics</h5>
                        <div class="seperator"></div>
                        <a href="{{ route('our_tutors') }}" class="btn btn-default btn-medium btn-primary-rounded">Find a Tutor</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 mb-5">
                <div class="card card-services">
                    <div class="card-image">
                        <img src="{{ asset('theme/images/small-2.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="card-body">
                        <h5>English Language Arts</h5>
                        <div class="seperator"></div>
                        <a href="{{ route('our_tutors') }}" class="btn btn-default btn-medium btn-primary-rounded">Find a Tutor</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 mb-5">
                <div class="card card-services">
                    <div class="card-image">
                        <img src="{{ asset('theme/images/small-5.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="card-body">
                        <h5>Sciences</h5>
                        <div class="seperator"></div>
                        <a href="{{ route('our_tutors') }}" class="btn btn-default btn-medium btn-primary-rounded">Find a Tutor</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12 mb-5"></div>
            <div class="col-lg-4 col-md-4 col-sm-12 mb-5">
                <div class="card card-services">
                    <div class="card-image">
                        <img src="{{ asset('theme/images/small-3.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="card-body">
                        <h5>Social Studies</h5>
                        <div class="seperator"></div>
                        <a href="{{ route('our_tutors') }}" class="btn btn-default btn-medium btn-primary-rounded">Find a Tutor</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 mb-5">
                <div class="card card-services">
                    <div class="card-image">
                        <img src="{{ asset('theme/images/small-1.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="card-body">
                        <h5>French</h5>
                        <div class="seperator"></div>
                        <a href="{{ route('our_tutors') }}" class="btn btn-default btn-medium btn-primary-rounded">Find a Tutor</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12 mb-5"></div>
        </div>
        <div class="mt-4"></div>
        <div class="row">
            <div class="col-12 text-center">
                <a href="{{ route('our_tutors') }}" class="btn btn-default btn-primary btn-large">View All Services</a>
            </div>
        </div>
        <div class="pt-4"></div>
    </div>
</section>

<section class="packages-section mb-0 pt-5 pb-5" style="background-image: url({{ asset('theme/images/feather-long-bg.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="section-heading">Packages</h2>
            </div>
            @foreach ($packages as $item)
                <div class="col-md-4 mb-3">
                    <div class="card position-relative text-center shadow {{ $loop->iteration == 2 ? 'center-package' : '' }}">
                        <div class="card-body">
                            <div class="icon-box">
                                @if ($loop->iteration == 1)
                                    <i data-feather="box"></i>
                                @elseif($loop->iteration == 2)
                                    <i data-feather="droplet"></i>
                                @else
                                    <i data-feather="star"></i>
                                @endif
                            </div>
                            <h6 class="package-rate">${{ $item->per_hour_amount }}<small>/h</small></h6>
                            <h4 class="package-name">{{ $item->name }}</h4>
                            <h2 class="total-rate">${{ $item->total_amount }}</h2>
                            <div class="package-description">
                                {!! $item->description !!}
                            </div>
                            <div class="buy-button">
                                <a href="{{ route('purchase', $item->id) }}" class="btn btn-default btn-small"><i data-feather="dollar-sign" style="width: 12px; height: 12px;"></i> Purchase</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@include('front.components.callus')

@include('front.components.contact')

@endsection
