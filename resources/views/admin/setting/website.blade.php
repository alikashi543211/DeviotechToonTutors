@extends('layouts.admin')
@section('title','Website Setting')
@section('nav-title', 'Website Setting')
@section('content')
<div class="container-fluid">
    <form method="post" action="{{route('admin.cms.store')}}">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Website Setting</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Commission Amount (%)</label>
                                    <input type="text" value="{{$setting['commission_amount'] ?? ''}}" name="commission_amount" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary pull-right">Submit</button>
        <a href="{{route('admin.dashboard')}}" class="btn btn-danger pull-right">Close</a>
    </form>
</div>
@endsection