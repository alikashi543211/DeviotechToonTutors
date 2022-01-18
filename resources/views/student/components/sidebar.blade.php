<aside class="sidebar">
    <div class="top-section text-center">
        <div class="avatar">
            @if (auth()->user()->student_profile->profile_photo != "")
                <img src="{{ asset(auth()->user()->student_profile->profile_photo) }}" class="img-fluid rounded-circle" alt="">
            @else
                <img src="{{ asset('default.png') }}" class="img-fluid rounded-circle" alt="">
            @endif

        </div>
        <h4>{{ auth()->user()->name }}</h4>
        <h6>Student</h6>

        <a href="{{ route('student.edit.profile') }}" class="btn btn-default btn-small mt-3"><i class="fa fa-pencil"></i> Edit Profile</a>
    </div>
    <div class="menu-section">
        <ul>
            <li class="@routeis('student.dashboard') active @endrouteis">
                <a href="{{ route('student.dashboard') }}"><span><i class="fa fa-th"></i></span> Dashboard</a>
            </li>
            <li class="@routeis('student.chat') active @endrouteis">
                <a href="{{ route('student.chat') }}"><span><i class="fa fa-comments"></i></span> Chat</a>
            </li>
            <li class="@routeis('student.packages') active @endrouteis">
                <a href="{{ route('student.packages') }}"><span><i class="fa fa-hourglass"></i></span> Buy Package</a>
            </li>
            <li class="@routeis('student.find.tutor') active @endrouteis">
                <a href="{{ route('student.find.tutor') }}"><span><i class="fa fa-graduation-cap"></i></span> Find Tutor</a>
            </li>
            <li class="@routeis('student.tutor.request') active @endrouteis">
                <a href="{{ route('student.tutor.request') }}"><span><i class="fa fa-user"></i></span> Your Requests</a>
            </li>
            <li class="@routeis('student.session.history') active @endrouteis">
                <a href="{{ route('student.session.history') }}"><span><i class="fa fa-podcast"></i></span> Session History</a>
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
            @if (auth()->user()->student_profile->profile_photo != "")
                <img src="{{ asset(auth()->user()->student_profile->profile_photo) }}" class="img-fluid rounded-circle" alt="">
            @else
                <img src="{{ asset('default.png') }}" class="img-fluid rounded-circle" alt="">
            @endif

        </div>
        <h4>{{ auth()->user()->name }}</h4>
        <h6>Student</h6>

        <a href="{{ route('student.edit.profile') }}" class="btn btn-default btn-small mt-3"><i class="fa fa-pencil"></i> Edit Profile</a>
    </div>
    <div class="menu-section">
        <ul>
            <li class="@routeis('student.dashboard') active @endrouteis">
                <a href="{{ route('student.dashboard') }}"><span><i class="fa fa-th"></i></span> Dashboard</a>
            </li>
            <li class="@routeis('student.chat') active @endrouteis">
                <a href="{{ route('student.chat') }}"><span><i class="fa fa-comments"></i></span> Chat</a>
            </li>
            <li class="@routeis('student.packages') active @endrouteis">
                <a href="{{ route('student.packages') }}"><span><i class="fa fa-hourglass"></i></span> Buy Package</a>
            </li>
            <li class="@routeis('student.find.tutor') active @endrouteis">
                <a href="{{ route('student.find.tutor') }}"><span><i class="fa fa-graduation-cap"></i></span> Find Tutor</a>
            </li>
            <li class="@routeis('student.tutor.request') active @endrouteis">
                <a href="{{ route('student.tutor.request') }}"><span><i class="fa fa-user"></i></span> Your Requests</a>
            </li>
            <li class="@routeis('student.session.history') active @endrouteis">
                <a href="{{ route('student.session.history') }}"><span><i class="fa fa-podcast"></i></span> Session History</a>
            </li>
            <li>
                <a href="javascript:;" onclick="document.getElementById('logout-form').submit()"><span><i class="fa fa-power-off"></i></span> Logout</a>
                <form id="logout-form" class="d-none" method="post" action="{{ route('logout') }}">@csrf</form>
            </li>
        </ul>
    </div>
</div>
