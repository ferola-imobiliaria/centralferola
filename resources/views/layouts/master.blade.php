<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} | @yield('page_title')</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('css/icheck-bootstrap.css') }}">

    <!-- JQVMap -->
{{--    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">--}}

<!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('css/OverlayScrollbars.css') }}">

    <!-- Daterange picker -->
{{--    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">--}}


<!-- custom css -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!-- Google Font: Source Sans Pro -->
    {{--    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">--}}
    <link
        href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,700;0,900;1,400&display=swap"
        rel="stylesheet">

    @hasSection('style')
        @yield('style')
    @endif
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
@include('layouts.includes.topnav')
<!-- /.navbar -->

    <!-- Main Sidebar Container -->
@include('layouts.includes.main_menu')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">
                            @yield('page_title')
                            <small>@yield('page_subtitle')</small>
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; {{ date('Y') }} Ferola Empreendimentos Imobiliários.</strong>
        Todos os direitos reservados.
        <div class="float-right d-none d-sm-inline-block">
            <b>Versão</b> 1.0.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('js/jquery.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
<!-- ChartJS -->
<!-- Sparkline -->
{{--<script src="plugins/sparklines/sparkline.js"></script>--}}
<!-- JQVMap -->
{{--<script src="plugins/jqvmap/jquery.vmap.min.js"></script>--}}
{{--<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>--}}
<!-- jQuery Knob Chart -->
{{--<script src="plugins/jquery-knob/jquery.knob.min.js"></script>--}}
<!-- daterangepicker -->
{{--<script src="plugins/moment/moment.min.js"></script>--}}
{{--<script src="plugins/daterangepicker/daterangepicker.js"></script>--}}
<!-- Tempusdominus Bootstrap 4 -->
{{--<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>--}}

<!-- overlayScrollbars -->
<script src="{{ asset('js/overlayScrollbars.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.js') }}"></script>

{{--Função para estilizar o item do menu ativo--}}
<script type="text/javascript">
    $('ul li.nav-item a.active').parents('li.has-treeview').addClass('menu-open');
    $('ul li.nav-item a.active').parents('.menu-open').find('a.nav-link:first').addClass('active');
</script>

<!-- Toastr -->
<script src="{{ asset('js/toastr.js') }}"></script>
{!! toastr()->render() !!}

@hasSection('js')
    @yield('js')
@endif

</body>
</html>
