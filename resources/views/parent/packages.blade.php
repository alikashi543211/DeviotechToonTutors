@extends('layouts.parent')
@section('title', 'Packages')
@section('content')
<section class="dashboard-header" style="background-image: url({{ asset('theme/images/feather-long-bg.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2><span style="color: #f26d64;">Packages</span></h2>
                <h6>Buy hourly Packages</h6>
            </div>
        </div>
    </div>
</section>
<section class="packages-section">
    <div class="container">
        <div class="row">
            @foreach ($packages as $item)
                <div class="col-md-4 mb-3">
                    <div class="card position-relative text-center {{ $loop->iteration == 2 ? 'center-package' : '' }}">
                        @if (count(auth()->user()->subscribe_plans) > 0 && auth()->user()->subscribe_plans->where('status','active')->first()->id == $item->id)
                            <div class="ribbon ribbon-top-left"><span>Purchased</span></div>
                        @endif
                        <div class="card-body">
                            <div class="icon-box">
                                @if ($loop->iteration == 1)
                                    <i data-feather="box"></i>
                                @elseif($loop->iteration == 2)
                                    <i data-feather="droplet"></i>
                                @else
                                    <i data-feather="star"></i>
                                @endif
                            </div>
                            <h6 class="package-rate">${{ $item->per_hour_amount }}<small>/h</small></h6>
                            <h4 class="package-name">{{ $item->name }}</h4>
                            <h2 class="total-rate">${{ $item->total_amount }}</h2>
                            <div class="package-description">
                                {!! $item->description !!}
                            </div>
                            <div class="buy-button">
                                <a href="{{ route('parent.package.payment', $item->id) }}" class="btn btn-default btn-small"><i data-feather="dollar-sign" style="width: 12px; height: 12px;"></i> Purchase</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
@section('js')
@endsection
