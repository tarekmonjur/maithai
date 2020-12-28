<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{$title ?? config('app.name')}}</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- overlayScrollbars -->
{{--    <link rel="stylesheet" href="{{asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">--}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('backend/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
    <!-- Google Font: Source Sans Pro -->
{{--    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">--}}

    @stack('style')
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed accent-danger text-sm @if(isset($sidebar_collapse) && $sidebar_collapse === true) sidebar-collapse @endif">
<div class="wrapper">
    <!-- Navbar -->
    @include('backend.layouts.common.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('backend.layouts.common.sidebar')
    <!-- /.sidebar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <div class="content" style="padding: .5rem 0 0">
            @yield('main_content')
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    @include('backend.layouts.common.footer')
    <!-- /.footer -->
</div>

<!---------- REQUIRED SCRIPTS ------->
<!-- jQuery -->
<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
{{--<script src="{{asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>--}}
<!-- AdminLTE -->
<script src="{{asset('backend/js/adminlte.min.js')}}"></script>
<script>
    window._baseURL = '{{ url('/') }}';
    window._assetURL = '{{ asset('/backend') }}';
    window._columns_config = '{!! json_encode($columns_config??[]) !!}';
    window._filters_config = '{!! json_encode($filters_config??[]) !!}';

    var current_url = '{{url()->current()}}';
    $(document).ready(function(){
        $(".nav-link[href='"+current_url+"']").addClass('active');
        $(".nav-link[href='"+current_url+"']").parents('li.has-treeview').addClass('menu-open');
    });
</script>

@stack('script')

</body>
</html>
