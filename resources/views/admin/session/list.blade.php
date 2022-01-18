@extends('layouts.admin')
@section('title','Sessions')
@section('nav-title', 'Sessions')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title font-weight-bold">Sessions</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table datatable table-bordered table-striped">
                            <thead class="text-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Zoom ID</th>
                                    <th>Session ID</th>
                                    <th>Tutor</th>
                                    <th>Student</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Student Joined</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->zoom_id }}</td>
                                    <td>{{$item->session_id}}</td>
                                    <td>{{ $item->tutor_user->name }}</td>
                                    <td>{{ $item->student_user->name }}</td>
                                    <td>{{ $item->time_taken }} mins</td>
                                    <td>
                                        @if ($item->status == 0)
                                            <span class="badge badge-info">Not started</span>
                                        @elseif($item->status == 1)
                                            <span class="badge badge-success">Started</span>
                                        @else
                                            <span class="badge badge-warning">Ended</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->student_joined)
                                            <span class="badge badge-success">Yes</span>
                                        @else
                                            <span class="badge badge-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                         <button type="button" onclick="deleteAlert('{{route('admin.session.delete',$item->id)}}')" title="Delete" class="btn btn-sm btn-danger"><i class="material-icons delete_icon">delete</i></button>
                                        @if($item->refund_request != "3")
                                            <a href="{{route('admin.refund',$item->id)}}" class="btn btn-sm btn-info">Refund</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
