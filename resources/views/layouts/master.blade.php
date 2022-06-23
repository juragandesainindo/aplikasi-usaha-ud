<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi Usaha | @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('dist/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('dist/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dist/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/dist/css/adminlte.min.css') }}">

    <style>
    </style>
    @livewireStyles()
</head>

<body class="hold-transition layout-top-nav">

    @include('sweetalert::alert')

    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="{{ url('/') }}" class="navbar-brand">
                    <img src="{{ asset('dist/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">AplUs</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ url('/') }}"
                                class="nav-link {{ Request()->is('/') ? 'active' : '' }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('data-usaha') }}"
                                class="nav-link {{ Request()->is('data-usaha') ? 'active' : '' }}">Data Usaha</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('periode') }}"
                                class="nav-link {{ Request()->is('periode') ? 'active' : '' }}">Periode</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('pembelian') }}"
                                class="nav-link {{ Request()->is('pembelian') ? 'active' : '' }}">Pembelian</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('penjualan') }}"
                                class="nav-link {{ Request()->is('penjualan') ? 'active' : '' }}">Penjualan</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"
                                class="nav-link dropdown-toggle {{ Request()->is(['laporan-harian','laporan-bulanan','laporan-tahunan','laporan-grand-total']) ? 'active' : '' }}">Laporan</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="{{ url('laporan-harian') }}"
                                        class="dropdown-item {{ Request()->is('laporan-harian') ? 'active' : '' }}">Harian</a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li><a href="{{ url('laporan-bulanan') }}"
                                        class="dropdown-item {{ Request()->is('laporan-bulanan') ? 'active' : '' }}">Bulanan</a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li><a href="{{ url('laporan-tahunan') }}"
                                        class="dropdown-item {{ Request()->is('laporan-tahunan') ? 'active' : '' }}">Tahunan</a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li><a href="{{ url('laporan-grand-total') }}"
                                        class="dropdown-item {{ Request()->is('laporan-grand-total') ? 'active' : '' }}">Grand
                                        Total</a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Aplikasi Usaha
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2022 - {{ date('Y') }}
                <!--<a href="https://adminlte.io">AdminLTE.io</a>-->.
            </strong> All
            rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('dist/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('dist/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('dist/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('dist/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dist/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dist/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dist/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dist/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dist/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('dist/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dist/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dist/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dist/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dist/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('dist/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ asset('dist/dist/js/demo.js') }}"></script> --}}
    <script src="{{ asset('dist/dist/js/pages/dashboard3.js') }}"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        Highcharts.chart('chartDashboard', {
        chart: {
        type: 'column'
        },
        title: {
        text: 'Monthly Average Rainfall'
        },
        subtitle: {
        text: 'Source: WorldClimate.com'
        },
        xAxis: {
        categories: [
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'Jun',
        'Jul',
        'Aug',
        'Sep',
        'Oct',
        'Nov',
        'Dec'
        ],
        crosshair: true
        },
        yAxis: {
        min: 0,
        title: {
        text: 'Rainfall (mm)'
        }
        },
        tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span>
        <table>',
            pointFormat: '<tr>
                <td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td>
            </tr>',
            footerFormat: '</table>',
        shared: true,
        useHTML: true
        },
        plotOptions: {
        column: {
        pointPadding: 0.2,
        borderWidth: 0
        }
        },
        series: [{
        name: 'Tokyo',
        data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
        
        }, {
        name: 'New York',
        data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]
        
        }, {
        name: 'London',
        data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]
        
        }, {
        name: 'Berlin',
        data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
        
        }]
        });
    </script>

    <script>
        $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
    theme: 'bootstrap4'
    })
    })
    </script>

    @yield('js')
</body>

</html>