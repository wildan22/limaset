
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register Manajemen Inventaris</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/src/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="/src/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/src/login-style.css">
    <link rel="stylesheet" type="text/css" href="/src/fontawesome.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<body>
    <div class="login pt-5 mt-4">
        <div class="container pt-5">
            <div class="row pb-5">
                <div class="col-md-1"></div>
                <div class="col-md-6">
                    <img src="/img/login.png" class="img-fluid" alt="Responsive image">
                </div>
                <div class="col-md-4">
                    <h3>Manajemen Inventaris</h3>
                    <br>
                    <form action="{{ route('self.register') }}" method="post" id="passFormNewUser">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Anda" name="name" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Alamat E-Mail" name="email" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-text">
                                <span class="fas fa-lock" id="message"></span>
                            </div>
                            <input type="password" id="password" class="form-control @error('email') is-invalid @enderror" placeholder="Password" name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-text">
                                <span class="fas fa-lock" id="message"></span>
                            </div>
                            <input type="password" id="password_confirmation" class="form-control" placeholder="Konfirmasi Password" name="password_confirmation" required>
                        </div>
                        <div class="form-group mb-3">
                            <select class="form-control select2" data-placeholder="Pilih Unit" style="width: 100%;" name="unit" required>
                                <option value hidden disable>Pilih Unit</option>
                                @foreach($units as $unit)
                                <option value="{{$unit->id}}">{{$unit->alias}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="simpanBtnNew"  disabled="disabled" class="btn btn-primary btn-block">Register</button>
                        </div>
                    </form>
                    Sudah Terdaftar? <a href="/login">Klik Disini</a>
                </div>
            </div>
        </div>
    </div>


<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/select2/js/select2.js"></script>
<script type="application/javascript" src="/src/bootstrap.js"></script>
<script type="application/javascript" src="/src/fontawesome.js"></script>
@include('sweetalert::alert')

<script>
    $(function () {
        $('.select2').select2({
            placeholder: function () {
                $(this).data('placeholder');
            }
        });
    });
</script>
<script type="text/javascript">
    //UNTUK VALIDASI MIN 8 KARAKTER
    $('#password, #password_confirmation').on('keyup', function () {
        if ($('#password').val() == $('#password_confirmation').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else
            $('#message').html('Not Matching').css('color', 'red');
    });

    //UNTUK VALIDASI BUTTON DISABLE JIKA TIDAK MEMENUHI KONDISI
    document.getElementById('passFormNewUser').addEventListener("input", function () {
        console.log("Mantap");
        var password = document.getElementById("password").value;
        var conf_password = document.getElementById("password_confirmation").value;
        if (password == conf_password && password.length > 7 && conf_password.length > 7) {
            simpanBtnNew.removeAttribute('disabled');
        } else {
            simpanBtnNew.setAttribute('disabled', 'disabled');
        }
    });
</script>
</body>
</html>

{{-- <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register Manajemen Inventaris</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css"> 
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Select2 -->
    <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href=""><b>Manajemen Inventaris</b></a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new membership</p>

                <form action="{{ route('self.register') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Full name" name="name" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control @error('email') is-invalid @enderror" placeholder="Password" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control select2" data-placeholder="UNIT" style="width: 100%;" name="unit" required>
                            <option value hidden disable></option>
                            @foreach($units as $unit)
                            <option value="{{$unit->id}}">{{$unit->alias}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


                <a href="/login" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <script src="../../plugins/select2/js/select2.js"></script>
    <script>
        $(function () {
            $('.select2').select2({
                placeholder: function () {
                    $(this).data('placeholder');
                }
            });
        });
    </script>
    @include('sweetalert::alert')
</body>

</html> --}}