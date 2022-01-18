<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin_theme/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('admin_theme/admin_theme/img/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title> @yield('title') | Admin Toon Tutors </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Quicksand:300,400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{ asset('admin_theme/css/material-dashboard.css?v=2.1.2') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <style>
        body {
            overflow-x: hidden
        }

        .h1,
        .h2,
        .h3,
        .h4,
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: Quicksand
        }

        .sidebar .nav p {
            font-weight: 500;
        }

        .card .card-header .card-title {
            font-weight: bold !important;
        }

        .page-item.active .page-link {
            background-color: #9c27b0 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: transparent;
            border: none;
        }

        .sidebar {
            overflow: hidden;
        }

        .lg-sidebar-toggle {
            font-size: 20px;
            position: fixed;
            left: 26px;
            top: 16px;
            z-index: 10000;
            padding: 5px;
            background: #fff;
            border-radius: 50%;
        }

        .table thead th {
            border-top-width: 1px !important;
            color: #000 !important;
            font-weight: bold !important;
            font-size: 14px !important;
        }

        .table thead th {
            border-top-width: 1px !important;
            color: #000 !important;
            font-weight: bold !important;
            font-size: 14px !important;
        }

        .table>tbody>tr>td {
            font-weight: 500;
        }

        .dataTables_paginate .pagination {
            justify-content: center;
            float: right;
        }

        .table thead th {
            border-top-width: 1px;
        }

        .bmd-form-group .bmd-label-floating,
        .bmd-form-group .bmd-label-placeholder {
            left: 10px;
        }

        .form-control {
            border: 2px solid #eee;
            border-radius: 8px;
            padding: 4px 10px;
        }

        input.form-control,
        textarea.form-control {
            background-image: none !important;
        }

        input.form-control,
        select.form-control {
            height: calc(2.4375rem + 2px) !important;
        }

        label,
        .bmd-label-static {
            font-weight: bold;
            text-transform: capitalize;
            margin-bottom: 3px;
            color: #000;
        }

        .input-group input {
            flex: none !important;
            width: 85% !important;
        }

        .input-group .input-group-append {

            width: 15% !important;
        }

        .card-title {
            font-weight: bold;
        }

        .navbar .navbar-brand {
            font-weight: bold;
        }

        .dataTables_filter {
            text-align: right;
        }

        .dataTables_paginate .pagination {
            justify-content: right;
        }

        .dataTables_length select {
            margin-left: 4px;
            min-width: 10px;
        }

        .collapsein {
            margin-top: 20px;
            padding-left: 1.5rem;
            margin-bottom: 0;
            list-style: none;
        }

        span.badge {
            font-weight: bold;
        }

        .card [class*="card-header-"] .card-icon,
        .card [class*="card-header-"] .card-text {
            margin-right: 10px;
        }

        .card-stats .card-footer {
            border-top: none !important;
            padding-top: 0px;
        }

        .sidebar .logo .simple-text {
            font-weight: bold;
        }

        .table>tbody>tr>td {
            font-weight: 500;
        }

        @media(max-width: 991px) {
            .lg-sidebar-toggle {
                display: none;
            }
        }
        .profile--block .info {
            font-size: 16px;
            line-height: 26px;
        }

        .profile--block .info th {
            position: relative;
            padding-right: 15px;
            text-transform: uppercase;
            z-index: 0;
        }

        .profile--block .info th:after {
            content: ":";
            position: absolute;
            top: -1px;
            right: 0;
            font-weight: normal;
        }

        .profile--block .info th .fa {
            min-width: 16px;
            margin-right: 15px;
        }

        .profile--block .info td {
            padding-left: 8px;
        }

        .profile--block .info tr + tr th,
        .profile--block .info tr + tr td {
            padding-top: 18px;
        }

        .profile--block .info tr + tr th:after {
            top: 17px;
        }

        #toast-container>.toast-success {
            opacity: 1 !important;
        }

        #toast-container>.toast-error {
            opacity: 1 !important;
        }
    </style>
    @yield('css')
</head>

<body class="">
    <div class="wrapper">
        <div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ asset('admin_theme/img/sidebar-1.jpg') }}">
            @include('admin.components.sidebar')
        </div>
        <div class="main-panel">
            @include('admin.components.navbar')
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('admin_theme/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_theme/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('admin_theme/js/core/bootstrap-material-design.min.js') }}"></script>
    <script src="{{ asset('admin_theme/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('admin_theme/js/plugins/moment.min.js') }}"></script>
    <script src="{{ asset('admin_theme/js/plugins/sweetalert2.js') }}"></script>
    <script src="{{ asset('admin_theme/js/plugins/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin_theme/js/plugins/bootstrap-selectpicker.js') }}"></script>
    <script src="{{ asset('admin_theme/js/plugins/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('admin_theme/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_theme/js/plugins/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ asset('admin_theme/js/plugins/jasny-bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_theme/js/plugins/nouislider.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <script src="{{ asset('admin_theme/js/plugins/chartist.min.js') }}"></script>
    <script src="{{ asset('admin_theme/js/plugins/bootstrap-notify.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('admin_theme/js/material-dashboard.js?v=2.1.2') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('table.datatable').DataTable({
                ordering: false,
                pageLength: 10
            });
        });
        @if(session('success'))
        toastr.success("{{ session('success') }}");
        @elseif(session('error'))
        toastr.error("{{ session('error') }}");
        @endif
        toastr.options = {
            "timeOut": "10000",
        }
        // General Delete Function
        function deleteAlert(url)
        {
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    location.href = url;
                }
            });
        }

        // General Status Change Function
        function changeStatus(url, message)
        {
            Swal.fire({
            title: 'Are you sure?',
            text: message,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, do it!'
            }).then((result) => {
                if (result.value) {
                    location.href = url;
                }
            });
        }
    </script>

    @yield('js')
</body>

</html>
