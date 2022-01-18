@extends('layouts.admin')
@section('title','Dashboard')
@section('nav-title', 'Dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">school</i>
                    </div>
                    <p class="card-category">Total Students</p>
                    <h3 class="card-title">{{$total_students}}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">person</i>
                    </div>
                    <p class="card-category">Total Tutors</p>
                    <h3 class="card-title">{{$total_tutors}}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">supervisor_account</i>
                    </div>
                    <p class="card-category">Total Parents</p>
                    <h3 class="card-title">{{$total_parents}}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">monetization_on</i>
                    </div>
                    <p class="card-category">Total Payouts</p>
                    <h3 class="card-title">$0</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title font-weight-bold">Recent Sessions</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table datatable table-bordered table-striped">
                            <thead class="text-primary">
                                <tr>
                                    <th>#</th>
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
                                @foreach($session as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->session_id }}</td>
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
