@extends('layouts.admin')
@section('title','Parents')
@section('nav-title', 'Parents')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title font-weight-bold">Parents</h4>
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
                                    <th>Students</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list as $item)
                                    <tzr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($item->parent_profile->profile_photo == "")
                                                <img src="{{ asset('default.png') }}" class="img-fluid rounded-circle" width="30" alt="DP">
                                            @else
                                                <img src="{{ asset($item->parent_profile->profile_photo) }}" class="img-fluid rounded-circle" width="30" alt="DP">
                                            @endif
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->parent_profile->phone }}</td>
                                        <td>
                                            <ul>
                                                @foreach ($item->parent_students as $ps)
                                                    <li>{{ $ps->student_name }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <button type="button" onclick="deleteAlert('{{route('admin.parent.delete',$item->id)}}')" title="Delete" class="btn btn-sm btn-danger"><i class="material-icons delete_icon">delete</i></button>
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
