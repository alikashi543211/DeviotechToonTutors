@extends('layouts.student')
@section('title', 'Dashboard')
@section('content')
<section class="dashboard-header" style="background-image: url({{ asset('theme/images/feather-long-bg.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2><span style="color: #f26d64;">Dashboard</span></h2>
                <h6>Welcome to the Student Dashboard</h6>
            </div>
        </div>
    </div>
</section>
<section class="join-session mt-3" style="display: none;">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="alert alert-custom">
                    <h6 class="mb-0">Your session is scheduled with "<span class="tutor_name"></span>" <a href="" target="_blank" class="btn btn-default btn-square">Join Session</a></h6>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-stats">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12 mb-4">
                <a href="{{ route('student.session.history') }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-icon mb-2">
                                <span class="rounded-circle"><i class="fa fa-podcast"></i></span>
                            </div>
                            <p class="font-weight-bold">Session Attended</p>
                            <h3>{{ $session_attended ?? '0' }}</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-12 mb-4">
                <a href="{{ route('student.tutor.request') }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-icon mb-2">
                                <span class="rounded-circle"><i class="fa fa-circle-o-notch"></i></span>
                            </div>
                            <p class="font-weight-bold">Upcoming Sessions</p>
                            <h3>{{ $upcoming ?? '0' }}</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-12 mb-4">
                <a href="{{ route('student.session.history') }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-icon mb-2">
                                <span class="rounded-circle"><i class="fa fa-circle-o-notch"></i></span>
                            </div>
                            <p class="font-weight-bold">Time (In Minutes)</p>
                            <h3>{{ $time ?? '0' }}</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-12 mb-4">
                <a href="{{ route('student.session.history') }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-icon mb-2">
                                <span class="rounded-circle"><i class="fa fa-usd"></i></span>
                            </div>
                            <p class="font-weight-bold">Money Spent</p>
                            <h3>0</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

@if (!is_null($purchased_plan))
<section class="purchased-packages mt-4 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="icon-box mb-3">
                    <i data-feather="droplet"></i>
                </div>
                <h3 class="text-dark">You have purchased "{{ $purchased_plan->package->name }}" Package</h3>
                <p>You have <strong>{{ $purchased_plan->remaining_hour }} hours</strong> left in your current package</p>
            </div>
        </div>
    </div>
</section>
@endif

<section class="recent-requests mt-4 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4 class="text-dark">Your Recent Requests</h4>
            </div>
            @if (count($requests) > 0)
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Teacher</th>
                                    <th>Date</th>
                                    <th>Time Slot</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($requests as $data)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>
                                        {{ $data->tutor_user->name }}
                                        <small class="font-weight-bold">
                                            <a href="javascript:;" class="view_profile" data-tutor-id="{{ $data->tutor_user->id }}">View Profile</a>
                                        </small>
                                    </td>
                                    <td>{{ studentDate($data->date, $data->slot) }}</td>
                                    <td>{{ studentSlot($data->slot) }}</td>
                                    <td>${{ $data->amount_paid }}</td>
                                    <td>
                                        @if($data->status == 'approved')
                                            <span class="badge badge-success">{{ $data->status }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ $data->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="col-12 mt-5 mb-5 text-center">
                    <img src="{{ asset('theme/images/no_search.svg') }}" width="80px" class="img-fluid" alt="">
                    <h3 class="text-dark mt-3">No Results Found.</h3>
                    <p>We don't yet have any results for this route.</p>
                </div>
            @endif
        </div>
    </div>
</section>

<section class="section-events">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div id="evoCalendar"></div>
            </div>
        </div>
    </div>
</section>
<div class="modal" data-easein="bounceIn" tabindex="-1" role="dialog" id="profileModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content tutor-profile">

        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $(".view_profile").click(function(){
                $.ajax({
                    type: "GET",
                    url: "{{ route('student.load.tutor.profile') }}/"+$(this).attr("data-tutor-id"),
                    success: function (response) {
                        $(".tutor-profile").html(response);
                        $("#profileModal").modal();
                    }
                });
            });

        });

        checkSessionStart();
        setInterval(checkSessionStart, 5000);
        function checkSessionStart()
        {
            $.ajax({
                type: "GET",
                url: "{{ route('student.check.session.start') }}",
                success: function (response) {
                    if(response.started){
                        $(".tutor_name").html(response.tutor);
                        $(".join-session").slideDown();
                        $(".join-session").find("a").attr("href", response.join_url);
                    } else{
                        $(".join-session").slideUp();
                    }
                }
            });
        }
        var data = <?php echo json_encode($events) ?>;

        $('#evoCalendar').evoCalendar({
            sidebarDisplayDefault: false,
            eventDisplayDefault: false,
            todayHighlight: true,
            sidebarToggler: true,
            eventListToggler: true,
            canAddEvent: false,
            calendarEvents: data,
            onSelectDate: function() {
                console.log('onSelectDate!');
                alert('f');
            },
            onAddEvent: function() {
                console.log('onAddEvent!')
            }
        });
        $('#evoCalendar').on('selectDate', function(event, newDate, oldDate) {
             console.log(event);
            $("#eventListToggler").click();
        });
    </script>
@endsection
