@extends('layouts.tutor')
@section('title', 'Student Requests')
@section('content')
<section class="tutor-dashboard-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Student Requests</h2>
                <h6>Here are the students waiting for you</h6>
            </div>
        </div>
    </div>
</section>
<section class="table-section">
    <div class="container">
        <div class="row">
            @if (count($requests) > 0)
                <div class="col-12 text-right mb-3">
                    <a href="javascript:void(0);" class="btn btn-default btn-small">Export CSV</a>
                </div>
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student Name</th>
                                    <th>Date</th>
                                    <th>Time Slot</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($requests as $item)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $item->student_user->name }}</td>
                                    <td>{{ $item->date}}</td>
                                    <td>{{ $item->slot }}</td>
                                    <td>${{ $item->amount_paid }}</td>
                                    <td>
                                        @if ($item->status == "pending")
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif ($item->status == "cancelled")
                                            <span class="badge badge-danger">Cancelled</span>
                                        @elseif ($item->status == "approved")
                                            <span class="badge badge-success">Approved</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- <a href="{{ route('tutor.chat') }}" class="icon-btn btn-primary rounded-circle" title="Chat"><i class="fa fa-comment"></i></a> --}}
                                        @if ($item->status == "cancelled" || $item->class_status == "completed")
                                            <a href="#delete" role="button" data-id="{{ $item->id }}" data-toggle="modal" class="icon-btn btn-danger rounded-circle delete" title="Delete"><i class="fa fa-trash"></i></a>
                                        @else
                                            @if ($item->status == "approved")
                                                <a href="#cancel" role="button" data-id="{{ $item->id }}" data-toggle="modal" class="icon-btn btn-danger rounded-circle text-white cancel" title="Cancel"><i class="fa fa-ban"></i></a>
                                            @else
                                                <a href="#accept" role="button" data-id="{{ $item->id }}" data-toggle="modal" class="icon-btn btn-success rounded-circle accept" title="Accept"><i class="fa fa-send"></i></a>
                                                <a href="#cancel" role="button" data-id="{{ $item->id }}" data-toggle="modal" class="icon-btn btn-danger rounded-circle text-white cancel" title="Cancel"><i class="fa fa-ban"></i></a>
                                            @endif
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

{{-- Accept Modal --}}
<div id="accept" class="modal" data-easein="bounceIn"  tabindex="-1" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Accept Request
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to accept this request?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default btn-square sure-accept" data-id="">
                    Sure
                </button>
            </div>
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

{{-- Delete Modal --}}
<div id="delete" class="modal" data-easein="bounceIn"  tabindex="-1" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Delete Request
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this request?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default btn-square sure-delete">
                    Sure
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).on("click", ".accept", function(){
            $(".sure-accept").attr('data-id', $(this).attr('data-id'));
        });

        $(document).on("click", ".cancel", function(){
            $(".sure-cancel").attr('data-id', $(this).attr('data-id'));
        });

        $(document).on("click", ".delete", function(){
            $(".sure-delete").attr('data-id', $(this).attr('data-id'));
        });

        $(document).on("click", ".sure-accept", function(){
            window.location.href = "{{ route('tutor.student.request.status') }}/accept/"+$(this).attr('data-id');
        });

        $(document).on("click", ".sure-cancel", function(){
            window.location.href = "{{ route('tutor.student.request.status') }}/cancel/"+$(this).attr('data-id');
        });

        $(document).on("click", ".sure-delete", function(){
            window.location.href = "{{ route('tutor.student.request.delete') }}/"+$(this).attr('data-id');
        });

    </script>
@endsection
