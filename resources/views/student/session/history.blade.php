@extends('layouts.student')
@section('title', 'Session History')
@section('content')
<section class="dashboard-header" style="background-image: url({{ asset('theme/images/feather-long-bg.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2><span style="color: #f26d64;">Session History</span></h2>
                <h6>History of your Classes</h6>
            </div>
        </div>
    </div>
</section>
<section class="table-section">
    <div class="container">
        <div class="row">
            @if (count($sessions) > 0)
                <div class="col-12 text-right mb-3">
                    <a href="javascript:void(0);" class="btn btn-default btn-small">Export CSV</a>
                </div>
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tutor</th>
                                    <th>Time Taken</th>
                                    <th>Amount</th>
                                    <th>Ratings</th>
                                    <th>Reviews</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sessions as $item)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>
                                        {{ $item->tutor_user->name }}
                                        <small class="font-weight-bold">
                                            <a href="javascript:;" class="view_profile" data-tutor-id="{{ $item->tutor_user->id }}">View Profile</a>
                                        </small>
                                    </td>
                                    <td>{{ $item->time_taken }} mins</td>
                                    <td>
                                        @if ($item->tutor_request->is_subscribed_payment == 1)
                                        "{{ $item->tutor_request->student_user->subscribe_plans->where('status','active')->first()->package->name }}" Package
                                        @else
                                        ${{ $item->tutor_request->amount }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->reviews->where('user_id',$item->tutor_user->id)->first()->rating ?? false)
                                        @for ($i = 0; $i < 5; $i++)
                                        @if (floor($item->reviews->where('user_id',$item->tutor_user->id)->first()->rating) - $i >= 1)
                                        {{--Full Star--}}
                                        <i style="color: #FFC125;" class="fa fa-star"></i>
                                        @elseif ($item->reviews->where('user_id',$item->tutor_user->id)->first()->rating - $i > 0)
                                        {{--Half Star--}}
                                        <i style="color: #FFC125;" class="fa fa-star-half-o"></i>
                                        @else
                                        {{--Empty Star--}}
                                        <i style="color: #FFC125;" class="fa fa-star-o"></i>
                                        @endif
                                        @endfor
                                        @else
                                        <i style="color: #FFC125;" class="fa fa-star-o"></i>
                                        <i style="color: #FFC125;" class="fa fa-star-o"></i>
                                        <i style="color: #FFC125;" class="fa fa-star-o"></i>
                                        <i style="color: #FFC125;" class="fa fa-star-o"></i>
                                        <i style="color: #FFC125;" class="fa fa-star-o"></i>
                                        @endif

                                    </td>
                                    <td>{{ $item->reviews->where('user_id',$item->tutor_user->id)->first()->review ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('student.review', $item->id) }}" class="btn btn-sm btn-primary" title="Rate">Rate</a>
                                        @if($item->refund_request != "3")
                                            <a data-sessionId="{{$item->session_id}}" class="btn btn-default btn-small btnRequestTutor text-white" data-toggle="modal" data-target="#request_refund">Request Refund</a>
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
<div class="modal" data-easein="bounceIn" tabindex="-1" role="dialog" id="profileModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content tutor-profile">

        </div>
    </div>
</div>
<div id="request_refund" class="modal" data-easein="bounceIn"  tabindex="-1" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Request Refund
                </h4>
            </div>
            <form action="{{route('student.refund')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="session_id" id="sessionId" value="">
                    <div class="form-group">
                        <label for="message">Subject</label>
                        <input type="text" name="subject" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Description</label>
                        <textarea name="message" id="description" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default btn-square" type="submit">Submit</button>
                </div>
            </form>
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
        $(".btnRequestTutor").click(function(){
            $('#sessionId').val($(this).attr('data-sessionId'));
        });
    });

</script>
@endsection
