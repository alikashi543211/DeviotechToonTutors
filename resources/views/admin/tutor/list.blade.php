@extends('layouts.admin')
@section('title','Tutors')
@section('nav-title', 'Tutors')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title font-weight-bold">Tutors</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table datatable table-bordered table-striped">
                            <thead class="text-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Picture</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Time Zone</th>
                                    <th>Hourly Rate</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($list->isNotEmpty())
                                @foreach($list as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <img src="{{ asset($item->tutor_profile->profile_photo) }}" class="img-fluid rounded-circle" width="30" alt="DP">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->tutor_profile->phone }}</td>
                                    <td>{{ $item->time_zone ?? 'N/A' }}</td>
                                    <td>${{ $item->tutor_profile->hourly_rate }}</td>
                                    <td>
                                        @if ($item->tutor_profile->status == "approved")
                                        <span class="badge badge-success">Approved</span>
                                        @else
                                        <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                       <a data-hourly_rate="{{$item->tutor_profile->hourly_rate}}" data-id="{{$item->tutor_profile->id}}" class="btn btn-sm btn-info btnRequestTutor text-white" data-toggle="modal" data-target="#request_refund">Hourly</a>
                                       @if ($item->tutor_profile->status == "approved")
                                       <button type="button" onclick="changeStatus('{{ route('admin.tutor.status', $item->id) }}', 'You want to decline profile of this tutor')" class="btn btn-sm btn-warning">Decline</button>
                                       @else
                                       <button type="button" onclick="changeStatus('{{ route('admin.tutor.status', $item->id) }}', 'You want to approve profile of this tutor')" class="btn btn-sm btn-success">Approve</button>
                                       @endif
                                       <a href="{{ route('admin.tutor.view', $item->id) }}" title="View Profile" class="btn btn-sm btn-primary"><i class="material-icons">visibility</i></a>
                                       <button type="button" onclick="deleteAlert('{{ route('admin.tutor.delete', $item->id) }}')" title="Delete" class="btn btn-sm btn-danger"><i class="material-icons delete_icon">delete</i></button>
                                   </td>
                               </tr>
                               @endforeach
                               @endif
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
<div id="request_refund" class="modal" data-easein="bounceIn"  tabindex="-1" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Set Hourly
                </h4>
            </div>
            <form action="{{route('admin.tutor.setHourly')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="message">Hourly Rate</label>
                        <input type="hidden" name="tutor_profile_id" value="">
                        <input type="text" name="hourly_rate" class="form-control" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-success btn-square" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function(){
        $(".btnRequestTutor").click(function(){
            $('input[name="hourly_rate"]').val($(this).attr('data-hourly_rate'));
            $('input[name="tutor_profile_id"]').val($(this).attr('data-id'));
        });
    });

</script>
@endsection