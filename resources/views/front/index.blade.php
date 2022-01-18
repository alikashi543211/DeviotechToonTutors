@extends('layouts.front')
@section('title', 'Home')
@section('content')
<section class="hero-section" style="background-image: url({{ asset('theme/images/banner-bg.png') }});">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="hero-text-wrapper">
                    @if(!empty($setting['banner_heading']))
                    <h1>{{$setting['banner_heading'] ?? ""}}</h1>
                    @endif
                    @if(!empty($setting['banner_sub_heading']))
                    <p class="text-white"> {{$setting['banner_sub_heading'] ?? ""}}.</p>
                    <!-- <br> One student at a time. -->
                    @endif
                    <a href="{{ route('our_tutors') }}" class="btn btn-default btn-square">Find a tutor</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="hero-img"><img src="{{ asset('theme/images/free-class.png') }}" class="img-fluid" alt=""></div>
            </div>
        </div>
    </div>
</section>

<section class="who-section" style="background-image: url({{ asset('theme/images/feather.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 text-md-center">
                <img src="{{ asset('theme/images/about-new.png') }}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="who-section-content">
                    @if(!empty($setting['section_3_title']))
                    <h5><em>{{$setting['section_3_title'] ?? ""}}.&nbsp;</em></h5>
                    @endif
                    @if(!empty($setting['section_3_description']))
                    <p>{{$setting['section_3_description'] ?? ""}}.</p>
                    @endif
                    <!-- <p>Our tutors are effective because of their recent knowledge and experience with the school curriculum.</p> -->
                </div>
            </div>
        </div>
    </div>
</section>

<section class="services-section" style="background-image: url({{ asset('theme/images/bg-contact.jpg') }});">
    <div class="fusion-section-separator">
        <div class="divider-candy-arrow bottom" style="top:0px;border-top-color: #ffffff;"></div>
        <div class="divider-candy bottom" style="bottom:-21px;border-bottom:1px solid #ffffff;
        border-left:1px solid #ffffff;"></div>
    </div>
    <div class="spacer-60"></div>
    <div class="container text-center">
        <div class="row">
            <div class="col-12">
                <h2>What we <span style="color: #f26d64;">Offer</span></h2>
                <div class="seperator-dark"></div>
            </div>
        </div>
        <div class="mt-5"></div>
        <div class="row">
            @if(!empty($setting['section_4_first_title']))
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-img">
                        <img src="{{ asset('theme/images/offer-1.png') }}" alt="">
                    </div>
                    <div class="card-body">
                        <h3>{{$setting['section_4_first_title'] ?? ""}}</h3>
                        <p>{{$setting['section_4_first_description'] ?? ""}}.</p>
                    </div>
                </div>
            </div> @endif

            @if(!empty($setting['section_4_second_title']))
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-img">
                        <img src="{{ asset('theme/images/offer-2.png') }}" alt="">
                    </div>
                    <div class="card-body">
                        <h3>{{$setting['section_4_second_title'] ?? ""}}</h3>
                        <p>{{$setting['section_4_second_description'] ?? ""}}.</p>
                    </div>
                </div>
            </div> @endif

            @if(!empty($setting['section_4_third_title']))
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-img">
                        <img src="{{ asset('theme/images/offer-3.png') }}" alt="">
                    </div>
                    <div class="card-body">
                        <h3>{{$setting['section_4_third_title'] ?? ""}}</h3>
                        <p>{{$setting['section_4_third_description'] ?? ""}}</p>
                    </div>
                </div>
            </div> @endif

        </div>
    </div>
</section>

<section class="how-it-works">
    <div class="container text-center">
        <div class="row">
            <div class="col-12">
                <h2>How does it / <span style="color: #f26d64;">work?</span></h2>
                <div class="seperator-dark"></div>
            </div>
        </div>
        <div class="mt-5"></div>
        <div class="row">
            @if(!empty($setting['section_5_first_title']))
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-img">
                        <img src="{{ asset('theme/images/how-work-1.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="card-body">
                        <h3>{{$setting['section_5_first_title'] ?? ""}}</h3>
                        <p>{{$setting['section_5_first_description'] ?? ""}}.</p>
                    </div>
                </div>
            </div> @endif

            @if(!empty($setting['section_5_second_title']))
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-img">
                        <img src="{{ asset('theme/images/how-work-2.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="card-body">
                        <h3>{{$setting['section_5_second_title'] ?? ""}}</h3>
                        <p>{{$setting['section_5_second_description'] ?? ""}}.</p>
                    </div>
                </div>
            </div> @endif

            @if(!empty($setting['section_5_third_title']))
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-img">
                        <img src="{{ asset('theme/images/how-work-3.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="card-body">
                        <h3>{{$setting['section_5_third_title'] ?? ""}}</h3>
                        <p>{{$setting['section_5_third_description'] ?? ""}}</p>
                    </div>
                </div>
            </div> @endif

        </div>
    </div>
</section>

@include('front.components.our_team')

@include('front.components.callus')

@include('front.components.contact')
@endsection
