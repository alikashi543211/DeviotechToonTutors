@extends('layouts.admin')
@section('title','Requests')
@section('nav-title', 'Requests')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-tabs card-header-primary">
                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                            <ul class="nav nav-tabs" data-tabs="tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#one_time" data-toggle="tab">
                                        <i class="material-icons">bug_report</i> One Time
                                        <div class="ripple-container"></div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#recurring" data-toggle="tab">
                                        <i class="material-icons">code</i> Recurring
                                        <div class="ripple-container"></div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="one_time">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table datatable table-bordered table-striped" width="100%">
                                            <thead class="text-primary">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tutor</th>
                                                    <th>Student</th>
                                                    <th>Date</th>
                                                    <th>Slot</th>
                                                    <th>Amount</th>
                                                    <th>Payment Status</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($one_time->isNotEmpty())
                                                    @foreach($one_time as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->tutor_user->name }}</td>
                                                        <td>{{ $item->student_user->name }}</td>
                                                        <td>{{ $item->active_date }}</td>
                                                        <td>{{ $item->slot }}</td>
                                                        <td>
                                                            @if ($item->is_subscribed_payment == 1)
                                                                "{{ $item->student_user->subscribe_plans->where('status','active')->first()->package->name }}" Package
                                                            @else
                                                                ${{ $item->amount }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($item->payment_status == 0)
                                                                <span class="badge badge-danger">Not Paid</span>
                                                            @else
                                                                <span class="badge badge-success">Paid</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($item->status == "pending")
                                                                <span class="badge badge-warning">pending</span>
                                                            @elseif($item->status == "approved")
                                                                <span class="badge badge-success">approved</span>
                                                            @elseif($item->status == "cancelled")
                                                                <span class="badge badge-danger">cancelled</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <button type="button" onclick="deleteAlert('{{route('admin.request.delete',$item->id)}}')" title="Delete" class="btn btn-sm btn-danger"><i class="material-icons delete_icon">delete</i></button>
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
                        <div class="tab-pane" id="recurring">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table datatable table-bordered table-striped" width="100%">
                                            <thead class="text-primary">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tutor</th>
                                                    <th>Student</th>
                                                    <th>Weeks</th>
                                                    <th>Remaining Weeks</th>
                                                    <th>Date</th>
                                                    <th>Slot</th>
                                                    <th>Amount</th>
                                                    <th>Paid</th>
                                                    <th>Payment Status</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($recurring->isNotEmpty())
                                                    @foreach($recurring as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->tutor_user->name }}</td>
                                                        <td>{{ $item->student_user->name }}</td>
                                                        <td>{{ $item->no_of_weeks }}</td>
                                                        <td>{{ $item->remaining_weeks }}</td>
                                                        <td>{{ $item->active_date }}</td>
                                                        <td>{{ $item->slot }}</td>
                                                        <td>
                                                            @if ($item->is_subscribed_payment == 1)
                                                                "{{ $item->student_user->subscribe_plans->where('status','active')->first()->package->name }}" Package
                                                            @else
                                                                ${{ $item->amount }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($item->is_subscribed_payment == 1)
                                                                "{{ $item->student_user->subscribe_plans->where('status','active')->first()->package->name }}" Package
                                                            @else
                                                                ${{ $item->amount_paid }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($item->payment_status == 0)
                                                                <span class="badge badge-danger">Not Paid</span>
                                                            @else
                                                                <span class="badge badge-success">Paid</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($item->status == "pending")
                                                                <span class="badge badge-warning">pending</span>
                                                            @elseif($item->status == "approved")
                                                                <span class="badge badge-success">approved</span>
                                                            @elseif($item->status == "cancelled")
                                                                <span class="badge badge-danger">cancelled</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{route('admin.request.delete',$item->id)}}" class="btn btn-sm btn-danger"><i class="material-icons delete_icon">delete</i></a>
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
            </div>
        </div>
    </div>
</div>
@endsection
