<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard | Gimanhal - Responsive Bootstrap 4 Property Owner Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL('dashboard_assets/images/favicon.ico') }}">


    <!-- Plugins css -->
    <link href="{{ url('dashboard_assets/libs/x-editable/bootstrap-editable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL('dashboard_assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <link href="{{ URL('dashboard_assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL('dashboard_assets/libs/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ URL('dashboard_assets/libs/clockpicker/bootstrap-clockpicker.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ URL('dashboard_assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="{{ URL('dashboard_assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL('dashboard_assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet" />

    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

    <link href="{{ URL('dashboard_assets/libs/dropify/dropify.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ URL('dashboard_assets/css/jquery-confirm.css') }}" />

    <!-- data table css -->
    <link href="{{ URL('dashboard_assets/libs/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL('dashboard_assets/libs/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL('dashboard_assets/libs/datatables/select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL('dashboard_assets/libs/switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />

    @yield('styles')
</head>

<body>
    <!-- Begin page -->
    <div id="wrapper">
        @include('account.referralUser.layouts.topbar')
        @include('account.referralUser.layouts.sidebar')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            @yield('content')
            @include('account.referralUser.layouts.footer')
        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->
    <!-- Vendor js -->
    <script src="{{ URL('dashboard_assets/js/vendor.min.js') }}"></script>

    <!--Morris Chart-->
    <script src="{{ URL('dashboard_assets/libs/morris-js/morris.min.js') }}"></script>
    <script src="{{ URL('dashboard_assets/libs/raphael/raphael.min.js') }}"></script>

    <!-- Dashboard init js-->
    <script src="{{ URL('dashboard_assets/js/pages/dashboard.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL('dashboard_assets/js/app.min.js') }}"></script>
    <script src="{{ URL('dashboard_assets/js/jquery-confirm.js') }}"></script>
    <script src="{{ URL('dashboard_assets/libs/switchery/switchery.min.js') }}"></script>

    <!-- data tables -->
    <script src="{{ URL('dashboard_assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL('dashboard_assets/libs/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL('dashboard_assets/libs/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL('dashboard_assets/libs/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ URL('dashboard_assets/libs/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL('dashboard_assets/libs/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL('dashboard_assets/libs/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ URL('dashboard_assets/libs/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ URL('dashboard_assets/libs/datatables/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ URL('dashboard_assets/libs/datatables/dataTables.select.min.js') }}"></script>
    <!-- Datatables init -->
    <script src="{{ URL('dashboard_assets/js/pages/datatables.init.js') }}"></script>

    <script src="{{ URL('dashboard_assets/libs/moment/moment.min.js') }}"></script>
    <script src="{{ URL('dashboard_assets/libs/clockpicker/bootstrap-clockpicker.min.js') }}"></script>
    <script src="{{ URL('dashboard_assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
    <!-- init -->
    <script src="{{ URL('dashboard_assets/js/pages/form-pickers.init.js') }}"></script>



    @yield('scripts')
</body>

</html>
