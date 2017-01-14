<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $page_title or "Metro Elektronik" }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset("/bower_components/admin-lte/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <!-- <link rel="stylesheet" href="/bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css"> -->
    <!-- Theme style -->
    <link href="{{ asset("/bower_components/admin-lte/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="{{ asset("/bower_components/admin-lte/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <!-- Header -->
    @include('layouts.public.header')

  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4">
        <!-- Main content -->
        <div class="content">
            <!-- Your Page Content Here -->
            @yield('content')
        </div><!-- /.content -->
        </div><!-- /.col -->
    </div><!-- /.row -->
  </div>

  <!-- Footer -->
    @include('layouts.footer')
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="{{ asset ("/bower_components/admin-lte/plugins/jQuery/jQuery-2.2.3.min.js") }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset ("/bower_components/admin-lte/bootstrap/js/bootstrap.min.js") }}"></script>
<!-- DataTables -->
<!-- <script src="{{ asset ("/bower_components/admin-lte/plugins/datatables/jquery.dataTables.min.js") }}"></script> -->
<!-- SlimScroll -->
<script src="{{ asset ("/bower_components/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
<!-- FastClick -->
<script src="{{ asset ("/bower_components/admin-lte//plugins/fastclick/fastclick.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset ("/bower_components/admin-lte/dist/js/app.min.js") }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset ("/bower_components/admin-lte/dist/js/demo.js") }}"></script>

{{-- Page specific script --}}
@yield('script')
</body>
</html>