@extends('layouts.front')
@section('title', 'Buy Hours')
@section('content')
<section class="page-hero-section" style="background-image: url({{ asset('theme/images/services.jpg') }});">
    <div class="page-hero-text-wrapper">
        <h2>See Our Packages</h2>
    </div>
    <a href="#main" class="angle-scrolldown"><i class="fa fa-angle-down"></i></a>
</section>
<div id="main"></div>
<section class="person-tutoring-section">
    <div class="container">
        <div class="services-heading-area">
            <h2>Online and In Person Tutoring</h2>
            <h4>K-12</h4>
            <h3>Starts  from $35 per hour</h3>
        </div>
        <div class="row">
            @foreach($packages as $package)
            <div class="col-lg-4 col-md-4 col-sm-12 mb-5">
                <div class="card text-center">
                    <div class="card-header request-free-consultation">
                        <h2 class="card-title text-light pb-1">Buy {{ $package->name }}</h2>
                    </div>
                    <div class="card-body">
                        <p>Starting From</p>
                        <h2 class="text-dark">{{ $package->total_amount }}$ ({{ $package->per_hour_amount.'$/hour' }})</h2>
                        <div class="seperator"></div>
                        <a href="{{ Auth::User()->role == 'student' ? route('student.hour.booking', $package->type) :  route('parent.hour.booking', $package->type) }}" class="mt-3 btn btn-default btn-medium btn-primary-rounded">Book Now</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="request-free-consultation">
    <div class="container text-center">
        <div class="row">
            <div class="col-12">
                <h2>Request a Free Consultation</h2>
            </div>
        </div>
    </div>
</section>

<section class="book-consultation" style="background-image: url({{ asset('theme/images/feather-long-bg.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="consultant-form">
                    <h2>Let's Get <span style="color: #f26d64;">Started</span></h2>
                    <p>We want you to have the opportunity to sit down with us, get to know what we’re all about, and how we can meet
                    your specific needs. To book a free consultation, please fill out the information below.</p>
                    <div class="mt-5"></div>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="parent_name">Parent's Name:</label>
                            <input type="text" name="parent_name" size="191" id="parent_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="student_name">Student's Name:</label>
                            <input type="text" name="student_name" size="191" id="student_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address:</label>
                            <input type="email" name="student_name" size="191" id="student_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number:</label>
                            <input type="text" name="phone_number" size="191" id="phone_number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="postal_code">Postal Code:</label>
                            <input type="text" name="postal_code" size="191" id="postal_code" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="subjects_and_grades">Subjects and Grade:</label>
                            <input type="text" name="subjects_and_grades" size="191" id="subjects_and_grades" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="other_comments">Other Comments:</label>
                            <textarea name="other_comments" id="other_comments" class="form-control" rows="7"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default btn-square">Send Now</button>
                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>

@include('front.components.callus')

@include('front.components.contact')

@endsection
