@extends('layouts.front')
@section('title', 'Login')
@section('content')
<section class="apply-now-section" style="background-image: url({{ asset('theme/images/feather-long-bg.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="apply-now-from">
                    <h2 class="text-center mb-4">Login <span style="color: #f26d64;">Here.</span></h2>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email Address:</label>
                            <input type="email" name="email" size="191" id="email" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" size="191" id="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="currently_enrolled">
                                <input type="checkbox" name="currently_enrolled" id="currently_enrolled" value="">
                                Remember Me
                            </label>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                        </div>
                        <div class="form-group text-center">
                            <p>Don't Have Account? <a href="{{ route('register') }}">Register Here</a></p>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-default btn-square text-center">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>


@endsection
