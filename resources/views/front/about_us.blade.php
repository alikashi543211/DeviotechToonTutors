@extends('layouts.front')
@section('title', 'About Us')
@section('content')
<section class="page-hero-section" style="background-image: url({{ asset('theme/images/about-us.jpg') }});">
    <div class="page-hero-text-wrapper">
        <h2>About Us</h2>
    </div>
    <a href="#main" class="angle-scrolldown"><i class="fa fa-angle-down"></i></a>
</section>
<div id="main"></div>
<section class="make-different-section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pb-4">
                <h3>What makes us <span style="color: #f26d64;">different? </span></h3>
                <div class="seperator-dark"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-2"></div>
            <div class="col-lg-3 col-md-3 text-center mb-5">
                <img src="{{ asset('theme/images/mentoring.jpg') }}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-5 col-md-5 mb-5">
                <h3>Mentorship</h3>
                <p>Making a difference in a student’s life takes individual attention, time, and effort. We know that sometimes
                it is important to go beyond the basic concepts. Our tutors are trained to help students build self confidence and
                self esteem while learning academic subjects. Your child’s tutor will not only serve as a teacher but also as a
                mentor for transitioning from schools, gaining test taking skills, and tackling everyday issues.</p>
            </div>
            <div class="col-lg-2 col-md-2"></div>
        </div>

        <div class="row">
            <div class="col-lg-2 col-md-2"></div>
            <div class="col-lg-5 col-md-5 mb-5">
                <h3>Communication</h3>
                <p>A parent’s role is important in any child’s education. We want parents to be informed and involved every step of
                    the way. You will receive regular updates of your child’s progress from your tutor and we are always be willing
                    to hear your comments and concerns.</p>
            </div>
            <div class="col-lg-3 col-md-3 text-center mb-5">
                <img src="{{ asset('theme/images/understanding-your-icon-project-e1504705313356.png') }}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-2 col-md-2"></div>
        </div>

        <div class="row">
            <div class="col-lg-2 col-md-2"></div>
            <div class="col-lg-3 col-md-3 text-center mb-5">
                <img src="{{ asset('theme/images/affordability2.jpg') }}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-5 col-md-5 mb-5">
                <h3>Affordability</h3>
                <p>We know you want to help your child exceed but don’t want to empty your pockets while you’re
                    at it! That’s why we offer the lowest rates in the province with absolutely no hidden fees. We
                    also have multiple packages for you to choose from based on what fits your budget.</p>
            </div>
            <div class="col-lg-2 col-md-2"></div>
        </div>

        <div class="row">
            <div class="col-lg-2 col-md-2"></div>
            <div class="col-lg-5 col-md-5 mb-5">
                <h3>Experience</h3>
                <p>Our tutors are effective because of their recent knowledge of and experience with the curriculum. With regular
                training we ensure that tutors are 100% aligned with the current curriculum and able to plan the sessions to help
                your child succeed.</p>
            </div>
            <div class="col-lg-3 col-md-3 text-center mb-5">
                <img src="{{ asset('theme/images/Experience1.png') }}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-2 col-md-2"></div>
        </div>
    </div>
</section>

<section class="our-story-section">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img src="{{ asset('theme/images/our-story.png') }}" class="img-fluid" alt="">
            </div>
            <div class="col-md-7">
                <h2>Our Story</h2>
                <div class="mt-3"></div>
                <p>My passion for tutoring began when I had a tutor of my own as a teenager. I found it difficult to relate to my tutor
                and understand the concepts I was having trouble with because I couldn’t engage with or relate to the tutor. I decided to
                ask older peers for help and found myself improving much quicker and gaining a strong grasp on the material. At that point,
                I searched for opportunities to help younger students the way my peers had helped me, but to my surprise I wasn’t able to
                find a platform for anyone my age. It was then, in 2015, that I worked with Hania to launch Toon Tutors to provide
                meaningful employment opportunities for youth and an individualized program for students.</p>
                <h4>Ghalia Aamer</h4>
                <div class="mt-3"></div>
                <h5>Co-Founder, Toon Tutors</h5>
            </div>
        </div>
    </div>
</section>

@include('front.components.our_team')

@include('front.components.callus')

@include('front.components.contact')

@endsection
