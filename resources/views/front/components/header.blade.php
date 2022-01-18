<header class="fixed-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg  custom-nav">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('theme/images/main-logo.jpg') }}" class="img-fluid" alt="Main Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse nav-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item @routeis('home') active @endrouteis">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item @routeis('about_us') active @endrouteis">
                        <a class="nav-link" href="{{ route('about_us') }}">About Us</a>
                    </li>
                    <li class="nav-item @routeis('our_services') active @endrouteis">
                        <a class="nav-link" href="{{ route('our_services') }}">Our Services</a>
                    </li>
                    <li class="nav-item @routeis('contact_us') active @endrouteis">
                        <a class="nav-link" href="{{ route('contact_us') }}">Contact Us</a>
                    </li>
                    <li class="nav-item @routeis('our_tutors') active @endrouteis">
                        <a class="nav-link" href="{{ route('our_tutors') }}">Our Tutors</a>
                    </li>
                    <li class="nav-item @routeis('join_team') active @endrouteis">
                        <a class="nav-link" href="{{ route('join_team') }}">Join Our Team</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            @if (auth()->user()->role == "student")
                                <a class="nav-link" href="{{ route('student.dashboard') }}">Dashboard</a>
                            @elseif(auth()->user()->role == "tutor")
                                <a class="nav-link" href="{{ route('tutor.dashboard') }}">Dashboard</a>
                            @elseif(auth()->user()->role == "parent")
                                <a class="nav-link" href="{{ route('parent.dashboard') }}">Dashboard</a>
                            @else
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            @endif
                        </li>
                    @else
                        <li class="nav-item @routeis('') active @endrouteis">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item @routeis('register') active @endrouteis">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </div>
</header>
