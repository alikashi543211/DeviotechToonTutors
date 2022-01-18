<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Toon Tutors</title>

    <link rel="shortcut icon" href="{{ asset('theme/images/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icomoon@1.0.0/style.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{ asset('theme/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/evo-calendar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('theme/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/bootstrap-multiselect.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/main.css?v=1.1') }}">
    <style>
        #toast-container > .toast-success {
                 opacity: 1 !important;
        }
        #toast-container > .toast-error {
            opacity: 1 !important;
        }
        .event-container{
            cursor:auto;
        }
        .multiselect.dropdown-toggle.custom-select{
            height: 43px !important;
            border-radius: 0px !important
        }
        span.select2 {
            display: table;
            table-layout: fixed;
            width: 100% !important;
        }
        .select2-container--default .select2-selection--single{
            height: 43px;
            padding: 8px 15px;
            border-radius: 0px;
            border-color: #d2d2d2;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow{
            height: 43px;
        }
        .select2-container .select2-selection--single .select2-selection__rendered{
            padding: 0px;
        }
        .nav-pills .nav-link{
            border-radius: 0px;
        }
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link{
            background-color: #f26d64;
        }
        .nav-pills .nav-link:hover{
            background-color: #f26d64;
            color: #fff;
            transition: 0.3s all;
        }
    </style>
    @yield('css')
</head>
<body>
    @include('parent.components.header')
    <div class="header-spacer"></div>
    <main class="dashboard">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12 p-0">
                    @include('parent.components.sidebar')
                </div>
                <div class="col-lg-9 col-md-12 col-sm-12 p-0">
                    @yield('content')

                    @include('parent.components.footer')
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('theme/js/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
    <script src="{{ asset('theme/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('theme/js/evo-calendar.js') }}"></script>
    <script src="{{ asset('theme/js/moment.min.js') }}"></script>
    <script src="{{ asset('theme/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('theme/js/easeScroll.js') }}"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.ui.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="{{ asset('theme/js/bootstrap-multiselect.min.js') }}"></script>
    <script src="{{ asset('theme/js/custom.js?v=1.1') }}"></script>
    <script>
        feather.replace();
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @elseif(session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>
    <script>
        $(function () {
            $('.select2').select2();
        });
        $(".angle-scrolldown").click(function() {
            $('html, body').animate({
                scrollTop: $("#main").offset().top - 100
            }, 2000);
        });
        $("html").easeScroll();
        $(".datepicker").datetimepicker();
        $(".multiselect").multiselect({
            buttonWidth: '100%'
        });
    </script>
    <script>
        (function(){
            $('.mobile-toggler').on('click', function(){
                $(this).toggleClass('is-active');
                $('.side-nav').toggleClass('side-nav--show');
            });
        }());
        $(window).resize(function(){
            if ($(window).width() > 991) {
                $('.side-nav').removeClass('side-nav--show');
            }
        });
    </script>
    @yield('js')
</body>
</html>
