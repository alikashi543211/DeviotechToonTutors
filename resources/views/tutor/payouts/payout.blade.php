@extends('layouts.tutor')
@section('title', 'Payouts')
@section('content')
<section class="tutor-dashboard-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Payouts</h2>
                <h6>All your earnings here</h6>
            </div>
        </div>
    </div>
</section>
<section class="section-stats">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-icon mb-2">
                            <span class="rounded-circle"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <p class="font-weight-bold">Total Hours</p>
                        <h3>{{ $total_hours ?? '0' }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-icon mb-2">
                            <span class="rounded-circle"><i class="fa fa-money"></i></span>
                        </div>
                        <p class="font-weight-bold">Net Income</p>
                        <h3>${{ $total_amount ?? '0' }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-icon mb-2">
                            <span class="rounded-circle"><i class="fa fa-credit-card"></i></span>
                        </div>
                        <p class="font-weight-bold">Widthrawn</p>
                        <h3>$0</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-icon mb-2">
                            <span class="rounded-circle"><i class="fa fa-usd"></i></span>
                        </div>
                        <p class="font-weight-bold">Available</p>
                        <h3>$0</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="table-section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-right mb-3">
                @if (is_null(auth()->user()->tutor_profile->stripe_account))
                    <a href="{{ route('connect', auth()->user()->id) }}" class="btn btn-default btn-small">Connect Stripe</a>
                @else
                    {{-- @if(auth()->user()->tutor_profile->is_boarded == 0)
                        <a href="{{ route('stripe.account') }}" target="_blank" class="btn btn-default btn-small">Complete Boarding</a>
                    @endif --}}
                    <a href="{{ route('stripe.account') }}" target="_blank" class="btn btn-default btn-small">Go To Stripe</a>
                @endif
                <a href="javascript:void(0);" class="btn btn-default btn-small">Export CSV</a>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Hours</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payouts as $item)
                                <tr>
                                    <td>{{ $item->created_at->format('d-M-Y') }}</td>
                                    <td>{{ $item->hours }}</td>
                                    <td>${{ $item->amount }}</td>
                                    <td>
                                        @if ($item->status == "due")
                                            <span class="badge badge-danger">Due</span>
                                        @else
                                            <span class="badge badge-success">Cleared</span>
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
</section>
@endsection
