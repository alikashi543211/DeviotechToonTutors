@extends('layouts.parent')
@section('title', 'Find Tutor')
@section('content')
<section class="dashboard-header" style="background-image: url({{ asset('theme/images/bg-contact.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2><span style="color: #f26d64;">Find Tutor</span></h2>
                <h6>The Best We Have</h6>
            </div>
        </div>
    </div>
</section>
<section class="section-coaches">
    <div class="container">
        <form action="{{ route('parent.find.tutor') }}" method="GET">
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
                    <input type="text" class="custom-search" placeholder="Search..." name="search" value="{{ $request->search ?? '' }}" id="search" autocomplete="off">
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
                                        <h5>${{ $data->tutor_profile->hourly_rate }}</h5>
                                    </div>
                                </div>
                                <p class="mt-2" style="min-height: 70px;">
                                    {{ Str::limit($data->tutor_profile->bio, 60,'') }}
                                    <a class="btn p-0 readMoreBtn" data-text="{{ $data->tutor_profile->bio }}">Read More...</a>
                                </p>
                                <div class="clearfix">
                                    <div class="float-left">
                                        <a data-tutor-id="{{ $data->id }}" class="btn btn-default btn-small btnRequestTutor text-white">Request Tutor</a>
                                    </div>
                                    <div class="float-right">
                                        <div class="rating text-right m-auto">
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
</section>

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
            <form action="{{ route('parent.request.tutor') }}" method="POST">
                @csrf
                <input type="hidden" id="tutor_id" name="tutor_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="parent_student_id">Student</label>
                        <select name="parent_student_id" id="parent_student_id" class="form-control">
                            <option value="" disabled selected>Select Student</option>
                            @foreach (auth()->user()->parent_students as $item)
                                <option value="{{ $item->id }}">{{ $item->student_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message">Write a message to Tutor</label>
                        <textarea name="message" id="message" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="interval">Interval</label>
                                <select name="interval" id="interval" class="form-control" style="border-radius: 0px; height: 43px;">
                                    <option value="1">One Time</option>
                                    <option value="2">Recurring</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="no_of_weeks d-none">
                                    <label for="no_of_weeks">No of Weeks</label>
                                    <input type="number" name="no_of_weeks" class="form-control" id="no_of_weeks">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <p><strong>Note:</strong> Select multiple time slots to schedule a session longer than half an hour.</p>
                    </div>
                    <div class="form-group">
                        <label for="data">Book Slot</label>
                        {{-- <input type="text" name="slot" id="data" class="form-control tutordatepicker" autocomplete="off"> --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                {{-- <select name="day" id="day" class="form-control">
                                    <option value="" disabled selected>Select Day</option>
                                </select> --}}
                                <input type="text" name="date" id="data" class="form-control tutordatepicker" autocomplete="off" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <select name="slot[]" id="slot" class="form-control multiselect" style="height: 100%; border-radius:0px;" multiple required>
                                    <option value="" selected disabled>Select Time</option>
                                </select>
                            </div>

                            <div class="col-md-12 error-div">
                                <span class="invalid-feedback font-weight-bold">Tutor is not available at this day</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default btn-square" type="submit">Submit</button>
                </div>
            </form>
        </div>
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
@endsection
@section('js')
    <script>
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        $('.selectpicker').selectpicker();
        $(".tutordatepicker").datetimepicker({
            minDate: today,
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
            format: 'YYYY/MM/DD',
            disabledDates: [''],
        });
        $(document).ready(function(){
            $(".readMoreBtn").click(function(){
                $('#appendReadMoreBio').text($(this).attr('data-text'));
                $("#readMoreModal").modal();
            });

            $(".btnRequestTutor").click(function(){
                $('#tutor_id').val($(this).attr('data-tutor-id'));
                $.ajax({
                    type: "GET",
                    url: "{{ route('parent.load.tutor.days') }}/"+$(this).attr('data-tutor-id'),
                    success: function (response) {
                        $("#day").html(response);
                        $("#costumModal10").modal();
                    }
                });
            });

            $("#interval").change(function (e) {
                e.preventDefault();
                if ($(this).val() == 2) {
                    $(".no_of_weeks").removeClass('d-none');
                } else {
                    $(".no_of_weeks").addClass('d-none');
                }
            });

            $(document).on("dp.change", ".tutordatepicker", function(e) {
                e.preventDefault();
                var tutor_id = $(this).closest("form").find('#tutor_id').val();
                // $("#slot").prop('disabled', true);
                $(".error-div .invalid-feedback").css('display', 'none');
                $.ajax({
                    type: "GET",
                    url: "{{ route('parent.load.tutor.intervals') }}/"+tutor_id+"?day="+$(this).val(),
                    success: function (response) {
                        if (response[1] == 200) {
                            // $("#slot").prop('disabled', false);
                            $(".multiselect").multiselect('destroy');
                            $(".multiselect").multiselect({
                                buttonWidth: '100%',
                                maxHeight: '100%',
                                checkbox: true,
                            });
                            $("#slot").html(response[0]);
                        } else {
                            $("#slot").html(response[0]);
                            $(".error-div .invalid-feedback").css('display', 'block');
                        }
                        console.log(response);
                    }
                });
            });
        });
    </script>
@endsection
