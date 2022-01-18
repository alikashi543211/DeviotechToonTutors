@extends('layouts.tutor')
@section('title', 'Session History')
@section('content')
<section class="tutor-dashboard-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Session History</h2>
                <h6>History of your hours</h6>
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
                                    <th>Student</th>
                                    <th>Time Taken</th>
                                    <th>Ratings</th>
                                    <th>Reviews</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sessions as $item)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $item->student_user->name }}</td>
                                        <td>{{ $item->time_taken }} mins</td>
                                        <td>
                                            @if ($item->reviews->where('user_id',$item->student_user->id)->first()->rating ?? false)
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if (floor($item->reviews->where('user_id',$item->student_user->id)->first()->rating) - $i >= 1)
                                                        {{--Full Star--}}
                                                        <i style="color: #FFC125;" class="fa fa-star"></i>
                                                    @elseif ($item->reviews->where('user_id',$item->student_user->id)->first()->rating - $i > 0)
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
                                        <td>{{ $item->reviews->where('user_id',$item->student_user->id)->first()->review ?? 'N/A' }}</td>
                                        <td>
                                            <a href="#delete" role="button" data-id="{{ $item->id }}" data-toggle="modal" class="icon-btn rounded-circle btn-danger delete" title="Delete"><i class="fa fa-trash"></i></a>
                                            <a href="{{ route('tutor.review', $item->id) }}" class="btn btn-sm btn-primary" title="Rate">Rate</a>
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

{{-- Delete Modal --}}
<div id="delete" class="modal" data-easein="bounceIn"  tabindex="-1" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Delete Session
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
        $(document).on("click", ".delete", function(){
            $(".sure-delete").attr('data-id', $(this).attr('data-id'));
        });

        $(document).on("click", ".sure-delete", function(){
            window.location.href = "{{ route('tutor.session.delete') }}/"+$(this).attr('data-id');
        });

    </script>
@endsection
