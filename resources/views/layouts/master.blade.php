<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <title>Metro - @yield('title')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />

    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset('/bower_components/admin-lte/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://use.fontawesome.com/018274a26e.css">

    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset('/bower_components/admin-lte/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/bower_components/admin-lte/dist/css/skins/skin-green.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/css/lib/c3.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link href="{{ asset('/bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    
    <link href="{{ asset ('/assets/css/lib/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset ('/assets/css/style.css') }}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-green layout-boxed sidebar-mini">
<div class="wrapper">

    {{-- Page header (navigation bar) --}}
    @include('layouts.header')

    <!-- Sidebar -->
    @include('layouts.sidebar')

    <div class="modals-container">
        <div class="container-fluid">
            {{-- Page specific modals --}}
            @yield('modals')
        </div>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('title')
                <small>@yield('desc')</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            {{-- Page content --}}
            @yield('content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    {{-- Page footer --}}
    @include('layouts.footer')


</div><!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.3 -->
<script src="{{ asset ('/bower_components/admin-lte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset ('/assets/js/lib/jquery-ui.min.js') }}" type="text/javascript"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset ('/bower_components/admin-lte/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset ('/bower_components/admin-lte/dist/js/app.min.js') }}" type="text/javascript"></script>
<!-- Slimscroll -->
<script src="{{ asset ('/bower_components/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<!-- FastClick -->
<script src="{{ asset ('/bower_components/admin-lte/plugins/fastclick/fastclick.js') }}" type="text/javascript"></script>
<!-- DataTables -->
<script src="{{ asset ('/bower_components/admin-lte/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset ('/assets/js/lib/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset ('/assets/js/lib/d3.min.js') }}" type="text/javascript"></script>
<script src="{{ asset ('/assets/js/lib/c3.min.js') }}" type="text/javascript"></script>

<!-- <script src="https://datatables.yajrabox.com/js/jquery.min.js"></script> -->
<script src="https://datatables.yajrabox.com/js/bootstrap.min.js"></script>
<script src="https://datatables.yajrabox.com/js/jquery.dataTables.min.js"></script>
<script src="https://datatables.yajrabox.com/js/datatables.bootstrap.js"></script>
<script src="https://datatables.yajrabox.com/js/handlebars.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.0.0/jquery.mark.min.js"></script>
<script src="https://use.fontawesome.com/018274a26e.js"></script>

<script src="{{ asset ('assets/js/main.js') }}" type="text/javascript"></script>
<script src="{{ asset ('assets/js/lib/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset ('assets/js/lib/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

<!-- <script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete"
                    async defer></script> -->

<script src="https://maps.googleapis.com/maps/api/js?v=3&libraries=places&key=AIzaSyDlyBhbwtX883kPO6s16Hkgw1lscjpeEQc&language=id"></script>

{{-- Page specific script --}}
@yield('script')


</body>
</html>