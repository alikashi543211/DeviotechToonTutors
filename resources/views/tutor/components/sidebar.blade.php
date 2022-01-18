<aside class="sidebar">
    <div class="top-section text-center">
        <div class="avatar">
            @if (auth()->user()->tutor_profile->profile_photo != "")
                <img src="{{ asset(auth()->user()->tutor_profile->profile_photo) }}" class="img-fluid rounded-circle" alt="">
            @else
                <img src="{{ asset('default.png') }}" class="img-fluid rounded-circle" alt="">
            @endif

        </div>
        <h4>{{ auth()->user()->name }}</h4>
        <h6>Tutor</h6>
        @if (auth()->user()->tutor_profile->status == "approved")
            <a href="{{ route('tutor.edit.profile') }}" class="btn btn-default btn-small mt-3"><i class="fa fa-pencil"></i> Edit Profile</a>
        @endif
    </div>
    <div class="menu-section">
        <ul>
            @if (auth()->user()->tutor_profile->status == "approved")
                <li class="@routeis('tutor.dashboard') active @endrouteis">
                    <a href="{{ route('tutor.dashboard') }}"><span><i class="fa fa-th"></i></span> Dashboard</a>
                </li>
                <li class="@routeis('tutor.chat') active @endrouteis">
                    <a href="{{ route('tutor.chat') }}"><span><i class="fa fa-comments"></i></span> Chat</a>
                </li>
                <li class="@routeis('tutor.student.requests') active @endrouteis">
                    <a href="{{ route('tutor.student.requests') }}"><span><i class="fa fa-anchor"></i></span> Student Requests</a>
                </li>
                <li class="@routeis('tutor.session.history') active @endrouteis">
                    <a href="{{ route('tutor.session.history') }}"><span><i class="fa fa-podcast"></i></span> Session History</a>
                </li>
                <li class="@routeis('tutor.payout') active @endrouteis">
                    <a href="{{ route('tutor.payout') }}"><span><i class="fa fa-usd"></i></span> Payouts</a>
                </li>
            @endif
            <li>
                <a href="javascript:;" onclick="document.getElementById('logout-form').submit()"><span><i class="fa fa-power-off"></i></span> Logout</a>
                <form id="logout-form" class="d-none" method="post" action="{{ route('logout') }}">@csrf</form>
            </li>
        </ul>
    </div>

</aside>
<div class="side-nav">
    <div class="top-section text-center">
        <div class="avatar">
            @if (auth()->user()->tutor_profile->profile_photo != "")
                <img src="{{ asset(auth()->user()->tutor_profile->profile_photo) }}" class="img-fluid rounded-circle" alt="">
            @else
                <img src="{{ asset('default.png') }}" class="img-fluid rounded-circle" alt="">
            @endif

        </div>
        <h4>{{ auth()->user()->name }}</h4>
        <h6>Tutor</h6>
        @if (auth()->user()->tutor_profile->status == "approved")
            <a href="{{ route('tutor.edit.profile') }}" class="btn btn-default btn-small mt-3"><i class="fa fa-pencil"></i> Edit Profile</a>
        @endif
    </div>
    <div class="menu-section">
        <ul>
            @if (auth()->user()->tutor_profile->status == "approved")
                <li class="@routeis('tutor.dashboard') active @endrouteis">
                    <a href="{{ route('tutor.dashboard') }}"><span><i class="fa fa-th"></i></span> Dashboard</a>
                </li>
                <li class="@routeis('tutor.chat') active @endrouteis">
                    <a href="{{ route('tutor.chat') }}"><span><i class="fa fa-comments"></i></span> Chat</a>
                </li>
                <li class="@routeis('tutor.student.requests') active @endrouteis">
                    <a href="{{ route('tutor.student.requests') }}"><span><i class="fa fa-anchor"></i></span> Student Requests</a>
                </li>
                <li class="@routeis('tutor.session.history') active @endrouteis">
                    <a href="{{ route('tutor.session.history') }}"><span><i class="fa fa-podcast"></i></span> Session History</a>
                </li>
                <li class="@routeis('tutor.payout') active @endrouteis">
                    <a href="{{ route('tutor.payout') }}"><span><i class="fa fa-usd"></i></span> Payouts</a>
                </li>
            @endif
            <li>
                <a href="javascript:;" onclick="document.getElementById('logout-form').submit()"><span><i class="fa fa-power-off"></i></span> Logout</a>
                <form id="logout-form" class="d-none" method="post" action="{{ route('logout') }}">@csrf</form>
            </li>
        </ul>
    </div>

</div>
