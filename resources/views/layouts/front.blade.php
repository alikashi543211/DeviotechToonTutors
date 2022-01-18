<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Toon Tutors</title>
    <link rel="shortcut icon" href="{{ asset('theme/images/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icomoon@1.0.0/style.min.css">
    <link rel="stylesheet" href="{{ asset('theme/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.3/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('theme/css/main.css?v=1.1') }}">
    <style>
        .bootstrap-datetimepicker-widget{
            color: #000000;
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
        .error{
            width: 100%;
            margin-top: .25rem;
            font-size: 80%;
            color: #dc3545;
        }
        .text-underline
        {
            text-decoration: underline !important;
        }
    </style>
    @yield('css')
</head>
<body>
    @include('front.components.header')
    <div class="header-spacer"></div>
    <main>
        @yield('content')
    </main>

    @include('front.components.footer')

    <script src="{{ asset('theme/js/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="{{ asset('theme/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('theme/js/moment.min.js') }}"></script>
    <script src="{{ asset('theme/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="{{ asset('theme/js/easeScroll.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.ui.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.3/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="{{ asset('theme/js/custom.js?v=1.1') }}"></script>
    <script>
        feather.replace();
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
        $(function () {
            $('.select2').select2();
        });
        $(".angle-scrolldown").click(function() {
            $('html, body').animate({
                scrollTop: $("#main").offset().top - 100
            }, 2000);
        });
        $(".dropify").dropify();
        $("html").easeScroll();
        $(function () {
            $('.datepicker').datetimepicker({
                useCurrent: false,
                icons: {
                    time: 'fa fa-clock-o',
                    date: 'fa fa-calendar',
                    up: 'fa fa-angle-up',
                    down: 'fa fa-angle-down',
                    previous: 'fa fa-angle-left',
                    next: 'fa fa-angle-right',
                    today: 'fa fa-bullseye',
                    clear: 'fa fa-trash',
                    close: 'fa fa-times'
                },
                format: 'YYYY/MM/DD',
            });
        });
    </script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/60001644a9a34e36b96c4ff9/1es05dv7a';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
    @yield('js')
</body>
</html>
