<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Manajemen Inventaris</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/src/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="/src/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/src/login-style.css">
    <link rel="stylesheet" type="text/css" href="/src/fontawesome.css">
    

    {{-- <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> --}}
</head>

<body>
    <div class="login pt-5 mt-4">
        <div class="container pt-5 mt-5">
            <div class="row pb-5">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <img src="/img/login.png" class="img-fluid" alt="Responsive image">
                </div>
                <div class="col-md-4">
                    <h3>Manajemen Inventaris</h3>
                    <br>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                            <input type="email" class="form-control" placeholder="Alamat E-Mail" name="email">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </form>
                    <br>
                    Belum Terdaftar? <a href="/regist">Klik Disini</a>
                </div>
            </div>
        </div>
    </div>

{{-- <body class="hold-transition login-page"> --}}
    {{-- <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Manajemen Inventaris</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-0">
                    <a href="/regist" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script> --}}
    @include('sweetalert::alert')
    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="application/javascript" src="/src/bootstrap.js"></script>
    <script type="application/javascript" src="/src/fontawesome.js"></script>
</body></html>
