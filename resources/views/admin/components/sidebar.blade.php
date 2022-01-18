<div class="logo"><a href="{{ route('admin.dashboard') }}" class="simple-text logo-normal">Toon Tutors</a></div>
<div class="sidebar-wrapper">
    <ul class="nav">
        <li class="nav-item @routeis('admin.dashboard') active @endrouteis">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="material-icons">dashboard</i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item @routeis('admin.packages.*') active @endrouteis">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#packages">
                <i class="material-icons">assistant</i>
                <p>Packages</p>
            </a>
            <div id="packages" class="collapse  @routeis('admin.packages.*') show @endrouteis">
                <ul class='wraplist' style="list-style-type:none;">
                    <li class="nav-item @routeis('admin.packages.add') active @endrouteis">
                        <a href="{{route('admin.packages.add')}}" class="nav-link">
                            <i class="material-icons mt-1 mr-1">add</i>
                            <p>Add Package</p>
                        </a>
                    </li>
                    <li class="nav-item @routeis('admin.packages.list') active @endrouteis">
                        <a href="{{route('admin.packages.list')}}" class="nav-link">
                            <i class="material-icons mt-1 mr-1">assistant</i>
                            <p>List Packages</p>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item @routeis('admin.student') active @endrouteis">
            <a class="nav-link" href="{{ route('admin.student') }}">
                <i class="material-icons">school</i>
                <p>Students</p>
            </a>
        </li>
        <li class="nav-item @routeis('admin.parent') active @endrouteis">
            <a class="nav-link" href="{{ route('admin.parent') }}">
                <i class="material-icons">supervisor_account</i>
                <p>Parents</p>
            </a>
        </li>
        <li class="nav-item @routeis('admin.tutor') active @endrouteis">
            <a class="nav-link" href="{{ route('admin.tutor') }}">
                <i class="material-icons">person</i>
                <p>Tutors</p>
            </a>
        </li>
        <li class="nav-item @routeis('admin.request') active @endrouteis">
            <a class="nav-link" href="{{ route('admin.request') }}">
                <i class="material-icons">request_page</i>
                <p>Requests</p>
            </a>
        </li>
        <li class="nav-item @routeis('admin.session') active @endrouteis">
            <a class="nav-link" href="{{ route('admin.session') }}">
                <i class="material-icons">online_prediction</i>
                <p>Sessions</p>
            </a>
        </li>
        <li class="nav-item @routeis('admin.payout') active @endrouteis">
            <a class="nav-link" href="{{ route('admin.payout') }}">
                <i class="material-icons">monetization_on</i>
                <p>Payouts</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#demo1">
                <i class="material-icons">
                    settings
                </i>
                <p>Settings</p>
            </a>
            <div id="demo1" class="collapse">
                <ul class='wraplist' style="list-style-type:none;">
                    <li class="nav-item @routeis('admin.cms.setting') active @endrouteis">
                        <a href="{{route('admin.cms.setting')}}" class="nav-link">
                            <p> CMS</p>
                        </a>
                    </li>
                    <li class="nav-item @routeis('admin.web.setting') active @endrouteis">
                        <a href="{{route('admin.web.setting')}}" class="nav-link">
                            <p>Web Setting</p>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item @routeis('admin.profile') active @endrouteis ">
            <a class="nav-link" href="{{route('admin.profile')}}">
                <i class="material-icons">person</i>
                <p>Profile</p>
            </a>
        </li>
    </ul>
</div>
