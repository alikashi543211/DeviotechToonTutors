@extends('layouts.admin')
@section('title','Payouts')
@section('nav-title', 'Payouts')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title font-weight-bold">Payouts</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table datatable table-bordered table-striped">
                            <thead class="text-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Hours</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payouts as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->created_at->format('d-M-Y') }}</td>
                                        <td>{{ $item->tutor->name }}</td>
                                        <td>{{ $item->hours }}</td>
                                        <td>${{ $item->amount }}</td>
                                        <td>
                                            @if ($item->status == "due")
                                                <span class="badge badge-danger">Due</span>
                                            @else
                                                <span class="badge badge-success">Cleared</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" onclick="deleteAlert('{{route('admin.payout.delete',$item->id)}}')" title="Delete" class="btn btn-sm btn-danger"><i class="material-icons delete_icon">delete</i></button>
                                            @if ($item->status == "due")
                                                <a href="{{ route('transfer', $item->id) }}" class="btn btn-sm btn-success">Transfer</a>
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
