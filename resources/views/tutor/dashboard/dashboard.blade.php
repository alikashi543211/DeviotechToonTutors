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
<section class="alert-section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                @if (count(auth()->user()->time_tables) <= 0)
                    <div class="alert alert-warning mt-2">
                        <p class="mb-0"><i class="fa fa-warning"></i> Please add timetable in profile to make it visible for students</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
<section class="join-session mt-3" style="display: none;">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="alert alert-custom">
                    <h6 class="mb-0">Your session is scheduled with "<span class="student_name"></span>" <a href="" target="_blank" class="btn btn-default btn-square">Start Session</a></h6>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-stats">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12 mb-4">
                <a href="{{ route('tutor.student.requests') }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-icon mb-2">
                                <span class="rounded-circle"><i class="fa fa-anchor"></i></span>
                            </div>
                            <p class="font-weight-bold">Student Requests</p>
                            <h3>{{ $requests ?? '0' }}</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-12 mb-4">
                <a href="{{ route('tutor.session.history') }}">
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
                <a href="{{ route('tutor.session.history') }}">
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
                <a href="{{ route('tutor.payout') }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-icon mb-2">
                                <span class="rounded-circle"><i class="fa fa-usd"></i></span>
                            </div>
                            <p class="font-weight-bold">Money Earned</p>
                            <h3>0</h3>
                        </div>
                    </div>
                </a>
            </div>
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
@endsection
@section('js')
    <script>
        checkSession();
        setInterval(checkSession, 5000);
        function checkSession()
        {
            $.ajax({
                type: "GET",
                url: "{{ route('tutor.check.session') }}",
                success: function (response) {
                    if(response.time_arrived){
                        $(".student_name").html(response.name);
                        $(".join-session").slideDown();
                        if (response.payment_status == 0) {
                            $(".join-session").find("a").attr("href", "javascript:;");
                            $(".join-session").find("a").addClass("not_paid");
                        } else {
                            $(".join-session").find("a").removeClass("not_paid");
                            $(".join-session").find("a").attr("href", "{{ route('start.session') }}/"+response.id);
                        }
                    } else{
                        $(".join-session").slideUp();
                    }
                }
            });
        }

        $(document).on("click", ".not_paid", function() {
            alert("Student didn't pay yet");
        });

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
        $('#evoCalendar .event-container').on('click', function(e) {
            e.preventDefault();
            $id = $(this).data('event-index');
            $url = "{{ route('start.session') }}/"+$id;
            var win = window.open($url, '_blank');
            if (win) {
                //Browser has allowed it to be opened
                win.focus();
            } else {
                //Browser has blocked it
                alert('Please allow popups for this website');
            }
        });
    </script>
@endsection
