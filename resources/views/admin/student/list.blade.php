@extends('layouts.admin')
@section('title','Students')
@section('nav-title', 'Students')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title font-weight-bold">Students</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-3">
                        <table class="table datatable table-bordered table-striped">
                            <thead class="text-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Time Zone</th>
                                    <th>Phone</th>
                                    <th>DOB</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($list->isNotEmpty())
                                @foreach($list as $item)
                                <tr>

                                    <td>{{$loop->iteration}}</td>
                                    <th>
                                        @if ($item->student_profile->profile_photo == "")
                                        <img src="{{ asset('default.png') }}" class="img-fluid rounded-circle" width="30" alt="DP">
                                        @else
                                        <img src="{{ asset($item->student_profile->profile_photo) }}" class="img-fluid rounded-circle" width="30" alt="DP">
                                        @endif
                                    </th>
                                    <td>{{ $item->name ?? "N/A" }}</td>
                                    <td>{{ $item->email ?? "N/A" }}</td>
                                    <td>{{ $item->time_zone ?? "N/A" }}</td>
                                    <th>{{ $item->student_profile->phone ?? "N/A" }}</th>
                                    <th>{{ $item->student_profile->dob ?? "N/A" }}</th>
                                    <td>
                                        <button type="button" onclick="deleteAlert('{{ route('admin.student.delete',$item->id) }}')" title="Delete" class="btn btn-sm btn-danger"><i class="material-icons delete_icon">delete</i></button>
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
<!-- Delete Modal -->
<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="myModalLabel160">Are You Sure</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                You want to Delete !
                <form method="GET" action="" class="manual">
                    <input type="hidden" name="id" id="delete_id" value="">
                    <button type="submit" class="btn btn-success" id="sure_del">Sure</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    $(document).on("click", ".del-btn", function(e) {
        $("#delete_id").val($(this).attr("data-href"));
        $("#delete_modal").modal('show');
    });
</script>
@endsection
