<aside class="sidebar">
    <div class="top-section text-center">
        <div class="avatar">
            @if (auth()->user()->parent_profile->profile_photo != "")
                <img src="{{ asset(auth()->user()->parent_profile->profile_photo) }}" class="img-fluid rounded-circle" alt="">
            @else
                <img src="{{ asset('default.png') }}" class="img-fluid rounded-circle" alt="">
            @endif

        </div>
        <h4>{{ auth()->user()->name }}</h4>
        <h6>Parent</h6>

        <a href="{{ route('parent.edit.profile') }}" class="btn btn-default btn-small mt-3"><i class="fa fa-pencil"></i> Edit Profile</a>
    </div>
    <div class="menu-section">
        <ul>
            <li class="@routeis('parent.dashboard') active @endrouteis">
                <a href="{{ route('parent.dashboard') }}"><span><i class="fa fa-th"></i></span> Dashboard</a>
            </li>
            <li class="@routeis('parent.chat') active @endrouteis">
                <a href="{{ route('parent.chat') }}"><span><i class="fa fa-comments"></i></span> Chat</a>
            </li>
            <li class="@routeis('parent.packages') active @endrouteis">
                <a href="{{ route('parent.packages') }}"><span><i class="fa fa-hourglass"></i></span> Buy Package</a>
            </li>
            <li class="@routeis('parent.find.tutor') active @endrouteis">
                <a href="{{ route('parent.find.tutor') }}"><span><i class="fa fa-graduation-cap"></i></span> Find Tutor</a>
            </li>
            <li class="@routeis('parent.tutor.request') active @endrouteis">
                <a href="{{ route('parent.tutor.request') }}"><span><i class="fa fa-user"></i></span> Your Requests</a>
            </li>
            <li class="@routeis('parent.session.history') active @endrouteis">
                <a href="{{ route('parent.session.history') }}"><span><i class="fa fa-podcast"></i></span> Session History</a>
            </li>
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
            @if (auth()->user()->parent_profile->profile_photo != "")
                <img src="{{ asset(auth()->user()->parent_profile->profile_photo) }}" class="img-fluid rounded-circle" alt="">
            @else
                <img src="{{ asset('default.png') }}" class="img-fluid rounded-circle" alt="">
            @endif

        </div>
        <h4>{{ auth()->user()->name }}</h4>
        <h6>Parent</h6>

        <a href="{{ route('parent.edit.profile') }}" class="btn btn-default btn-small mt-3"><i class="fa fa-pencil"></i> Edit Profile</a>
    </div>
    <div class="menu-section">
        <ul>
            <li class="@routeis('parent.dashboard') active @endrouteis">
                <a href="{{ route('parent.dashboard') }}"><span><i class="fa fa-th"></i></span> Dashboard</a>
            </li>
            <li class="@routeis('parent.chat') active @endrouteis">
                <a href="{{ route('parent.chat') }}"><span><i class="fa fa-comments"></i></span> Chat</a>
            </li>
            <li class="@routeis('parent.packages') active @endrouteis">
                <a href="{{ route('parent.packages') }}"><span><i class="fa fa-hourglass"></i></span> Buy Package</a>
            </li>
            <li class="@routeis('parent.find.tutor') active @endrouteis">
                <a href="{{ route('parent.find.tutor') }}"><span><i class="fa fa-graduation-cap"></i></span> Find Tutor</a>
            </li>
            <li class="@routeis('parent.tutor.request') active @endrouteis">
                <a href="{{ route('parent.tutor.request') }}"><span><i class="fa fa-user"></i></span> Your Requests</a>
            </li>
            <li class="@routeis('parent.session.history') active @endrouteis">
                <a href="{{ route('parent.session.history') }}"><span><i class="fa fa-podcast"></i></span> Session History</a>
            </li>
            <li>
                <a href="javascript:;" onclick="document.getElementById('logout-form').submit()"><span><i class="fa fa-power-off"></i></span> Logout</a>
                <form id="logout-form" class="d-none" method="post" action="{{ route('logout') }}">@csrf</form>
            </li>
        </ul>
    </div>
</div>
