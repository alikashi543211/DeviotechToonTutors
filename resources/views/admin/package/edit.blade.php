@extends('layouts.admin')
@section('title','Edit Package')
@section('nav-title', 'Packages')
@section('css')
<style type="text/css">
    .error {
        color: red !important;
    }
</style>
@endsection
@section('content')
<div class="container-fluid">
    <form method="post" action="{{route('admin.packages.save', $package->id)}}" class="cmxform" id="registration-form">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Add Package</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class="bmd-label-floating">Name</label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $package->name }}">
                            @error('name')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="hours" class="bmd-label-floating">Hours</label>
                            <input type="number" id="hours" name="hours" class="form-control @error('hours') is-invalid @enderror" value="{{ $package->hours }}">
                            @error('hours')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="per_hour_amount" class="bmd-label-floating">Per Hour Amount</label>
                            <input type="text" id="per_hour_amount" name="per_hour_amount" class="form-control @error('per_hour_amount') is-invalid @enderror" value="{{ $package->per_hour_amount }}">
                            @error('per_hour_amount')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="total_amount" class="bmd-label-floating">Total Amount</label>
                            <input type="text" id="total_amount" name="total_amount" class="form-control @error('total_amount') is-invalid @enderror" readonly value="{{ $package->total_amount }}">
                            @error('total_amount')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="description">{{ $package->description }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('js')
    <script>
        CKEDITOR.replace( 'description' );
        function calcAmount() {
            var hours = $("#hours").val();
            var per_hour = $("#per_hour_amount").val();
            if(hours == undefined || hours == null || hours == "")
                hours = 0;
            if(per_hour == undefined || per_hour == null || per_hour == "")
                per_hour = 0;

            var total_amt = hours * per_hour;
            $("#total_amount").val(total_amt);
        }
        $(document).ready(function () {
            $("#hours").keyup(function (e) {
                calcAmount();
            });
            $("#per_hour_amount").keyup(function (e) {
                calcAmount();
            });
        });
    </script>
@endsection
