@extends('layouts.sidebar')
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endsection

@section('page_title','Manajemen Inventaris - Form Inventaris')

@section('content-header')
<h3 class="text-center">Form Inventaris</h3>
<ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
@endsection

@section('content-main')
<!-- /.card-header -->
<div class="card">
    <div class="card-body">
        <form id="editForm" method="post" action="" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="email">Merk Perangkat</label>
                <input type="email" name="email" class="form-control" placeholder="Contoh: ASUS" required> @if ($errors->has('email'))
                <div class="text-danger">
                    {{ $errors->first('email')}}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="email">Serial Number</label>
                <input type="email" name="email" class="form-control" placeholder="Contoh: ASDQWE1211" required> @if ($errors->has('email'))
                <div class="text-danger">
                    {{ $errors->first('email')}}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="email">Processor</label>
                <input type="email" name="email" class="form-control" placeholder="Contoh: AMD Ryzen 7" required> @if ($errors->has('email'))
                <div class="text-danger">
                    {{ $errors->first('email')}}
                </div>
                @endif
            </div>
            
            <div class="form-group">
                <label for="email">Computer Name</label>
                <input type="email" name="email" class="form-control" placeholder="Contoh: N7-BANTAIAN-MUTAQIN" required> @if ($errors->has('email'))
                <div class="text-danger">
                    {{ $errors->first('email')}}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="email">MAC. Address</label>
                <input type="email" name="email" class="form-control" placeholder=" Contoh: 12-13-14-AA-2A-3B" required> @if ($errors->has('email'))
                <div class="text-danger">
                    {{ $errors->first('email')}}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="email">Tahun Perolehan</label>
                <input type="email" name="email" class="form-control" placeholder="Contoh: 2020" required> @if ($errors->has('email'))
                <div class="text-danger">
                    {{ $errors->first('email')}}
                </div>
                @endif
            </div>

                <label>Silahkan Pilih</label>
            <div class="input-group mb-3">
                <select name="level" class="form-control" id="inputGroupSelect01" required>
                    <option value hidden disable>Pilih Kategori Perangkat</option>
                    {{-- @foreach($ as $l) --}}
                    <option value=""></option>
                    {{-- @endforeach --}}
                </select>
            </div>

            <div class="input-group mb-3">
                <select name="level" class="form-control" id="inputGroupSelect01" required>
                    <option value hidden disable>Pilih Jenis Perangkat</option>
                    {{-- @foreach($ as $l) --}}
                    <option value=""></option>
                    {{-- @endforeach --}}
                </select>
            </div>
            <div class="input-group mb-3">
                <select name="level" class="form-control" id="inputGroupSelect01" required>
                    <option value hidden disable>Pilih Ukuran Storage</option>
                    {{-- @foreach($ as $l) --}}
                    <option value=""></option>
                    {{-- @endforeach --}}
                </select>
            </div>
            <div class="input-group mb-3">
                <select name="level" class="form-control" id="inputGroupSelect01" required>
                    <option value hidden disable>Pilih Ukuran RAM</option>
                    {{-- @foreach($ as $l) --}}
                    <option value=""></option>
                    {{-- @endforeach --}}
                </select>
            </div>
            <div class="input-group mb-3">
                <select name="level" class="form-control" id="inputGroupSelect01" required>
                    <option value hidden disable>Pilih Sistem Operasi</option>
                    {{-- @foreach($ as $l) --}}
                    <option value=""></option>
                    {{-- @endforeach --}}
                </select>
            </div>
            <div class="form-group mt-3">
                <input id="simpanBtn"  type="submit" class="btn btn-success" value="Simpan">
            </div>
        </form>
    </div>
    <!-- /.card-body -->
</div>

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
