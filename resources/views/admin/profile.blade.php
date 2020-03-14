@extends('layouts.sidebar')
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endsection

@section('page_title','Manajemen User - List User')

@section('content-header')
<ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
@endsection

@section('content-main')
<!-- /.card-header -->
<div class="card col-7">
    <div class="container mt-3 ml-4">
       <b> Biodata Diri </b>
    </div>
    <div class="card-body">
        <div class="container">
            <div class="col">
                <div class="row">
                <div class="col-4"><label for="">Nama</label></div>
                <div class="col-8">Fikri Aulia</div>
                <div class="w-100"></div>
                <div class="col-4"><label for="">Unit</label></div>
                <div class="col-8">Bunga Mayang</div>
                <div class="w-100"></div>
                <div class="col-4"><label for="">Alamat E-Mail</label></div>
                <div class="col-8">fikri@mail.com</div>
                </div>
            </div>
        </div>
    
        <div class="card-footer bg-white">
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editDataModal">
                <i class="fas fa-edit text-white"> Edit</i>
            </button>
        </div>
    </div>
    <!-- /.card-body -->
</div>

{{-- Modal Edit User --}}
<div class="modal fade" id="editDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <center> <b>Edit Biodata Diri</b> </center>
                <form method="POST" id="passFormNewUser" action="">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Fikri"
                            required>

                        @if ($errors->has('nama'))
                        <div class="text-danger">
                            {{ $errors->first('nama')}}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email">Alamat E-Mail</label>
                        <input type="email" name="email" class="form-control" placeholder="fikri@mail.com"
                            required>

                        @if ($errors->has('email'))
                        <div class="text-danger">
                            {{ $errors->first('email')}}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="new_password">Password Baru (Min. 8 Digit)</label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Password" required> @if ($errors->has('new_password'))
                        <div class="text-danger">
                            {{ $errors->first('new_password')}}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="konfirmasi_password">Konfirmasi Password (Min. 8 Digit)</label><span
                            id='message'></span>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                            placeholder="Konfirmasi Password" required> @if ($errors->has('password_confirmation'))
                        <div class="text-danger">
                            {{ $errors->first('konfirmasi_password')}}
                        </div>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <input id="simpanBtnNew" disabled="disabled" type="submit" class="btn btn-success"
                            value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Akhir Edit User --}}

@endsection

@section('javascript')
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $(function () {
        $('#jenisram').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
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
@endsection
