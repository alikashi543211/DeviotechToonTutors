@extends('layouts.admin')
@section('title','List Packages')
@section('nav-title', 'Packages')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title font-weight-bold">List Packages</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table datatable table-bordered table-striped">
                            <thead class="text-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Hours</th>
                                    <th>Per Hour Charges</th>
                                    <th>Total Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($packages as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->hours }}</td>
                                    <td>{{ $item->per_hour_amount }}</td>
                                    <td>{{ $item->total_amount }}</td>
                                    <td>
                                        <a href="{{route('admin.packages.edit',$item->id)}}" class="btn btn-sm btn-info"><i class="material-icons">edit</i></a>
                                        <button type="button" onclick="deleteAlert('{{route('admin.packages.delete',$item->id)}}')" title="Delete" class="btn btn-sm btn-danger"><i class="material-icons delete_icon">delete</i></button>
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
