@extends('layouts.parent')
@section('title', 'Your Requests')
@section('content')
<section class="dashboard-header" style="background-image: url({{ asset('theme/images/feather-long-bg.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2><span style="color: #f26d64;">Your Requests</span></h2>
                <h6>Status of Tutor Request</h6>
            </div>
        </div>
    </div>
</section>
<section class="give-review-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item shadow mr-2">
                        <a class="nav-link active" id="pills-requests-tab" data-toggle="pill" href="#pills-requests" role="tab" aria-controls="pills-requests" aria-selected="true">Requests</a>
                    </li>
                    <li class="nav-item shadow">
                        <a class="nav-link" id="pills-classes-tab" data-toggle="pill" href="#pills-classes" role="tab" aria-controls="pills-classes" aria-selected="false">Classes</a>
                    </li>
                </ul>
            </div>
            <div class="col-12">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-requests" role="tabpanel" aria-labelledby="pills-requests-tab">
                        <div class="row">
                            @if (count($get_data) > 0)
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
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($get_data as $data)
                                                <tr>
                                                    <th>{{ $loop->iteration }}</th>
                                                    <td>
                                                        {{ $data->tutor_user->name }}
                                                        <small class="font-weight-bold">
                                                            <a href="javascript:;" class="view_profile" data-tutor-id="{{ $data->tutor_user->id }}">View Profile</a>
                                                        </small>
                                                    </td>
                                                    <td>{{ parentDate($data->date, $data->slot) }}</td>
                                                    <td>{{ parentSlot($data->slot) }}</td>
                                                    <td>${{ $data->amount }}</td>
                                                    <td>
                                                        @if($data->status == 'approved')
                                                            <span class="badge badge-success">{{ $data->status }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ $data->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="#cancel" role="button" data-id="{{ $data->id }}" data-toggle="modal" class="icon-btn btn-danger rounded-circle text-white cancel" title="Cancel"><i class="fa fa-ban"></i></a>
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
                    <div class="tab-pane fade" id="pills-classes" role="tabpanel" aria-labelledby="pills-classes-tab">
                        <div class="row">
                            @if (count($get_data))
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-custom">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Teacher</th>
                                                    <th>Date</th>
                                                    <th>Time Slot</th>
                                                    <th>Interval</th>
                                                    <th>Amount</th>
                                                    <th>Amount Paid</th>
                                                    <th>Status</th>
                                                    <th>Class Status</th>
                                                    <th>Payment Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($get_data as $data)
                                                <tr>
                                                    <th style="vertical-align: middle;">{{ $loop->iteration }}</th>
                                                    <td>{{ $data->tutor_user->name }}</td>
                                                    <td>{{ parentDate($data->active_date, $data->slot) }}</td>
                                                    <td>{{ parentSlot($data->slot) }}</td>
                                                    <td>
                                                        @if($data->interval == 1)
                                                            One Time
                                                        @else
                                                            Recurring
                                                        @endif
                                                    </td>
                                                    <td>

                                                        @if ($data->is_subscribed_payment == 1)
                                                            "{{ auth()->user()->subscribe_plans->where('status','active')->first()->package->name }}" Package
                                                        @else
                                                            ${{ $data->amount }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($data->is_subscribed_payment == 1)
                                                            "{{ auth()->user()->subscribe_plans->where('status','active')->first()->package->name }}" Package
                                                        @else
                                                            ${{ $data->amount_paid }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($data->status == 'approved')
                                                            <span class="badge badge-success">{{ $data->status }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ $data->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($data->class_status == 'pending')
                                                            <span class="badge badge-warning">{{ $data->class_status }}</span>
                                                        @elseif($data->class_status == 'completed')
                                                            <span class="badge badge-success">{{ $data->class_status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($data->payment_status == 1)
                                                            <span class="badge badge-success">Paid</span>
                                                        @else
                                                            <a href="{{ route('parent.recurring.payment', $data->id) }}"><span class="badge badge-danger">Not Paid</span> <br>Click to Pay</a>
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
                </div>
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

{{-- Decline Modal --}}
<div id="cancel" class="modal" data-easein="bounceIn"  tabindex="-1" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Cancel Request
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to cancel this request?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default btn-square sure-cancel">
                    Sure
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

    <script>
        $(document).ready(function(){
            $(document).on("click", ".view_profile", function (){
                $.ajax({
                    type: "GET",
                    url: "{{ route('parent.load.tutor.profile') }}/"+$(this).attr("data-tutor-id"),
                    success: function (response) {
                        $(".tutor-profile").html(response);
                        $("#profileModal").modal();
                    }
                });
            });
        });
        $(document).on("click", ".cancel", function(){
            $(".sure-cancel").attr('data-id', $(this).attr('data-id'));
        });

        $(document).on("click", ".sure-cancel", function(){
            window.location.href = "{{ route('parent.request.tutor.status') }}/cancel/"+$(this).attr('data-id');
        });
    </script>
@endsection
