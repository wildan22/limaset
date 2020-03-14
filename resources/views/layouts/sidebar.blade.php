
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>@yield('page_title')</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @yield('css')
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="../../dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
                        <span class="d-none d-md-inline">
                            {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">

                            <p>
                            {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}} -  {{Auth::user()->unit->alias}}
                                <small>Member since {{Auth::user()->simpleFormatCreatedAt()}}</small>

                                
                                
                            </p>
                        </li>
                        <!-- Menu Body -->

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="/admin/profile" class="btn btn-default btn-flat">Profile</a>
                            <a href="/logout" class="btn btn-default btn-flat float-right">Sign out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">{{Auth::user()->unit->alias}}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                @if(Auth::user()->level->keterangan == "ADMIN")
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="/admin" class="nav-link {{ Request::path() === 'admin' ? 'active': ''}}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link {{ request()->is('admin/data-master/*') ? 'active': ''}}">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                    Data Master
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/data-master/kategori" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kategori</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/data-master/jenis-perangkat" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jenis Perangkat</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/data-master/jenis-ram" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jenis Ram</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/data-master/sistem-operasi" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sistem Operasi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/data-master/unit" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Unit</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link {{ request()->is('admin/manajemen-user/*') ? 'active': ''}}">
                                <i class="fas fa-users-cog"></i>
                                <p>
                                    Manajemen User
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/manajemen-user/list-user" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>User List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/manajemen-user/pending-user" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pending User</p>
                                    </a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link {{ request()->is('admin/manajemen-inventaris/*') ? 'active': ''}}">
                                <i class="fas fa-dolly"></i>
                                <p>
                                    Manajemen Inventaris
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/manajemen-inventaris/new-inventaris" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Inventaris</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/manajemen-inventaris/list-inventaris" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inventaris List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                @elseif(Auth::user()->level->keterangan == "OPERATOR")
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="/operator" class="nav-link {{ Request::path() === 'admin' ? 'active': ''}}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link {{ request()->is('operator/manajemen-inventaris/*') ? 'active': ''}}">
                                <i class="fas fa-dolly"></i>
                                <p>
                                    Manajemen Inventaris
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/operator/manajemen-inventaris/new-inventaris" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Inventaris</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/operator/manajemen-inventaris/list-inventaris" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inventaris List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                @endif
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                @yield('content-header')
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @yield('content-main')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                limaset@ptpn7.com
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>
    @include('sweetalert::alert')
    @yield('javascript')
</body>

</html>