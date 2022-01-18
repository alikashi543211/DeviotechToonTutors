@extends('layouts.admin')
@section('title','Tutors')
@section('nav-title', 'Tutors')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title font-weight-bold">Profile</h4>
                </div>
                <div class="card-body">
                    <div class="profile--block">
                        <div class="info">
                            <table class="ff--primary">
                                <tbody>
                                    <tr>
                                        <th>
                                            <i class="fa fa-usd"></i>
                                            <span>Hourly Rate</span>
                                        </th>
                                        <td>{{ $tutor->tutor_profile->hourly_rate ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <i class="fa fa-phone"></i>
                                            <span>Phone</span>
                                        </th>
                                        <td>{{ $tutor->tutor_profile->phone ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <i class="fa fa-laptop"></i>
                                            <span>Video Url</span>
                                        </th>
                                        <td>{{ $tutor->tutor_profile->video_url ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <i class="fa fa-calendar"></i>
                                            <span>DOB</span>
                                        </th>
                                        <td>{{ $tutor->tutor_profile->dob ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <i class="fa fa-book"></i>
                                            <span>Subjects</span>
                                        </th>
                                        <td>{{ $tutor->tutor_profile->subjects ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <i class="fa fa-id-card"></i>
                                            <span>Resume</span>
                                        </th>
                                        <td>
                                            @if (is_null($tutor->tutor_profile->resume))
                                                N/A
                                            @else
                                                <a href="{{ asset($tutor->tutor_profile->resume) }}" target="_blank">Click To View</a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <i class="fa fa-envelope-o"></i>
                                            <span>Cover Letter</span>
                                        </th>
                                        <td>
                                            @if (is_null($tutor->tutor_profile->cover_letter))
                                                N/A
                                            @else
                                                <a href="{{ asset($tutor->tutor_profile->cover_letter) }}" target="_blank">Click To View</a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <i class="fa fa-check-square-o"></i>
                                            <span>Status</span>
                                        </th>
                                        <td>
                                            @if ($tutor->tutor_profile->status == "approved")
                                                <span class="badge badge-success">Approved</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-avatar">
                    <a href="#pablo">
                        <img class="img" src="{{ asset($tutor->tutor_profile->picture ?? 'default.png') }}">
                    </a>
                </div>
                <div class="card-body">
                    <h6 class="card-category text-gray">Tutor</h6>
                    <h4 class="card-title">{{ $tutor->name }}</h4>
                    <p>
                        {{ $tutor->tutor_profile->bio ?? 'No Bio' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
