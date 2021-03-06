<html lang="en" dir="rtl">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <script src=" {{asset('assets/admin/ar/ckeditor/ckeditor.js')}}" ></script>

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <link href="{{asset('assets/admin/ar/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/ar/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/ar/global/plugins/bootstrap/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/ar/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/ar/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />

    <link href="{{asset('assets/admin/ar/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/ar/global/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/ar/global/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/ar/global/plugins/jqvmap/jqvmap/jqvmap.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{asset('assets/admin/ar/global/css/components-rtl.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{asset('assets/admin/ar/global/css/plugins-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/ar/chosen/chosen.min.css')}}" rel="stylesheet" type="text/css" />



    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->

    <link href="{{asset('assets/admin/ar/layouts/layout4/css/layout-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/ar/layouts/layout4/css/themes/light-rtl.min.css')}}" rel="stylesheet"  id="style_color"  type="text/css" />
    <link href="{{asset('assets/admin/ar/layouts/layout4/css/custom-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/ar/base.css')}}" rel="stylesheet" type="text/css" />
</head>
<!-- END HEAD -->

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">

@include('dashboard.includes.header')
<!-- ////////////////////////////////////////////////////////////////////////////-->
@include('dashboard.includes.sidebar')


@yield('content')
<!-- ////////////////////////////////////////////////////////////////////////////-->
@include('dashboard.includes.footer')
<script src="{{asset('assets/admin/ar/global/plugins/respond.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/excanvas.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/admin/ar/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/admin/ar/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('assets/admin/ar/global/plugins/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/morris/raphael-min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/amcharts/amcharts/amcharts.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/admin/ar/global/plugins/amcharts/amcharts/serial.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/amcharts/amcharts/pie.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/amcharts/amcharts/radar.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/amcharts/amcharts/themes/light.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/amcharts/amcharts/themes/patterns.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/admin/ar/global/plugins/amcharts/amcharts/themes/chalk.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/amcharts/ammap/ammap.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/amcharts/ammap/maps/js/worldLow.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/amcharts/amstockcharts/amstock.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/flot/jquery.flot.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/flot/jquery.flot.resize.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/flot/jquery.flot.categories.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/jqvmap/jqvmap/jquery.vmap.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/admin/ar/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->

<script src="{{asset('assets/admin/ar/global/scripts/app.min.js')}}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="{{asset('assets/admin/ar/pages/scripts/dashboard.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{asset('assets/admin/ar/layouts/layout4/scripts/layout.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/ar/layouts/layout4/scripts/demo.min.js')}}" type="text/javascript"></script>
<script src=" {{asset('assets/admin/ar/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src=" {{asset('assets/admin/ar/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
<script src=" {{asset('assets/admin/ar/chosen/chosen.jquery.js')}}" type="text/javascript"></script>
<script src=" {{asset('assets/admin/ar/custom.js')}}" type="text/javascript"></script>


<!-- END THEME LAYOUT SCRIPTS -->
<!-- END THEME LAYOUT SCRIPTS -->

</body>
@yield('script')
</html>

