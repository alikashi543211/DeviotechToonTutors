@extends('layouts.front')
@section('title', 'Our Tutors')
@section('content')
<section class="page-hero-section" style="background-image: url({{ asset('theme/images/our-tutors-bg.jpg') }});">
    <div class="page-hero-text-wrapper">
        <h2>Spreading Knowledge</h2>
    </div>
    <a href="#main" class="angle-scrolldown"><i class="fa fa-angle-down"></i></a>
</section>
<div id="main"></div>
<section class="empower-section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h6>THE BEST OF THE BEST</h6>
                <h1>Our Tutors.</h1>
            </div>
        </div>
        <div class="mt-5"></div>
        <form action="{{ route('our_tutors') }}" method="GET">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12 mb-4">
                    <select name="location" id="location" class="form-control">
                        <option value="" disabled selected>Location</option>
                        <option value="all" {{ $request->location == "all" ? 'selected' : '' }}>All</option>
                        @foreach(countries() as $country)
                            <option value="{{ $country->country_name }}" {{ $request->location == $country->country_name ? 'selected' : '' }}>{{ $country->country_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-sm-6 col-12 mb-4">
                    <select name="subject" id="subjects" class="form-control">
                        <option value="" disabled selected>Subjects</option>
                        <option value="all" {{ $request->subject == "all" ? 'selected' : '' }}>All</option>
                        @foreach(subjects() as $subject)
                            <option value="{{ $subject }}" {{ $request->subject == $subject ? 'selected' : '' }}>{{ $subject }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-sm-6 col-12 mb-4">
                    <select name="availability" id="availability" class="form-control">
                        <option value="" disabled selected>Availability</option>
                        <option value="morning" {{ $request->availability == "morning" ? 'selected' : '' }}>Morning</option>
                        <option value="evening" {{ $request->availability == "evening" ? 'selected' : '' }}>Evening</option>
                    </select>
                </div>
                <div class="col-md-3 col-sm-6 col-12 mb-4">
                    <input type="text" class="custom-search" placeholder="Search..." value="{{ $request->search ?? '' }}" name="search" id="search">
                </div>
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-default btn-medium">Search</button>
                </div>
            </div>
        </form>
        <div class="mt-4"></div>
        <div class="row">
            @if (count($get_data) > 0)
                <div class="col-12">
                    <h5>{{ count($get_data) }} results </h4>
                </div>
                <div class="mt-5"></div>

                @foreach($get_data as $data)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card">
                        <img src="{{ asset($data->tutor_profile->profile_photo) }}" class="card-img" alt="">
                        <div class="card-body">
                            <div class="coach-detail">
                                <div class="clearfix">
                                    <div class="float-left">
                                        <h5 class="mb-0">{{ $data->name }}</h5>
                                        <small class="text-muted">{{ $data->tutor_profile->subjects }}</small>
                                    </div>
                                    <div class="float-right">
                                        <h5 class="mb-0">${{ $data->tutor_profile->hourly_rate }}</h5>
                                    </div>
                                </div>
                                <p class="mt-2" style="min-height: 70px;">
                                    {{ Str::limit($data->tutor_profile->bio, 85,'') }}
                                    <a class="btn p-0 readMoreBtn" data-text="{{ $data->tutor_profile->bio }}">Read More...</a>
                                </p>
                                <div class="clearfix">
                                    <div class="float-left">
                                        @auth
                                            @if (auth()->user()->role == "tutor")
                                                
                                            @else
                                                <a data-tutor-id="{{ $data->id }}" class="btn btn-default btn-small btnRequestTutor text-white">Request Tutor</a>
                                            @endif
                                        @else
                                            <a href="{{ route('student.find.tutor') }}" class="btn btn-default btn-small">Request Tutor</a>
                                        @endauth
                                    </div>
                                    <div class="float-right">
                                        <div class="rating text-right">
                                            {{-- <span>4.7</span> --}}
                                            <a href=""><i class="fa fa-star"></i></a>
                                            <a href=""><i class="fa fa-star"></i></a>
                                            <a href=""><i class="fa fa-star"></i></a>
                                            <a href=""><i class="fa fa-star"></i></a>
                                            <a href=""><i class="fa fa-star-half-o"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <img src="{{ asset('theme/images/no_search.svg') }}" width="80px" class="img-fluid" alt="">
                    <h3 class="text-dark mt-3">No Results Found.</h3>
                    <p>We can't find any tutor matching your search.</p>
                </div>
            @endif
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="readMoreModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body font-weight-bold">
              <p id="appendReadMoreBio"></p>
            </div>
          </div>
        </div>
      </div>
</section>



@include('front.components.callus')

@include('front.components.contact')
{{-- Request Coach Modal --}}
<div id="costumModal10" class="modal" data-easein="bounceIn"  tabindex="-1" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Request Tutor
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="form-div">

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $('.selectpicker').selectpicker();

        $(document).ready(function(){
            $(".readMoreBtn").click(function(){
                $('#appendReadMoreBio').text($(this).attr('data-text'));
                $("#readMoreModal").modal();
            });

            $(".btnRequestTutor").click(function(){
                $.ajax({
                    type: "GET",
                    url: "{{ route('load.request.form') }}/"+$(this).attr('data-tutor-id'),
                    success: function (response) {
                        $(".form-div").html(response);
                        $(".tutordatepicker").datetimepicker({
                            icons: {
                                time: 'fa fa-clock-o',
                                date: 'fa fa-calendar',
                                up: 'fa fa-angle-up',
                                down: 'fa fa-angle-down',
                                previous: 'fa fa-angle-left',
                                next: 'fa fa-angle-right',
                                today: 'fa fa-bullseye',
                                clear: 'fa fa-trash',
                                close: 'fa fa-times'
                            },
                            format: 'YYYY/MM/DD HH:mm',
                            disabledDates: [''],
                        });
                        $("#costumModal10").modal();
                    }
                });
            });

            $(document).on("change", "#parent_student_id", function(e) {
                e.preventDefault();
                $(document).find("#message").prop("disabled", false);
                $(document).find("#data").prop("disabled", false);
            });
        });

    </script>
@endsection
