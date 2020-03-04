@extends('layouts.sidebar')
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endsection

@section('page_title','List User Terdaftar')

@section('content-header')
<h3 class="text-center">List User Terdaftar</h3>
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
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahDataModal">
            Tambah User
        </button>
        <table id="jenisram" class="table table-bordered table-hover">
            @php
            $no = 1;
            @endphp
            <thead>
                <tr>
                    <th width="5%">No. </th>
                    <th width="25%">Nama</th>
                    <th width="25%">Email</th>
                    <th width="20%">Level</th>
                    <th width="10%">Unit</th>
                    <th width="5">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->level->keterangan}}</td>
                    <td>{{$user->unit->alias}}</td>
                    <td class="text-center">
                        <a class="btn btn-warning text-white" data-toggle="modal"
                            data-target="#editModal-{{$user->id}}">
                            <i class="fas fa-edit"></i>
                        </a>
                        -
                        <a class="btn btn-danger text-white" data-toggle="modal"
                            data-target="#deleteModal-{{$user->id}}">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

@foreach ($users as $user)
<!-- Delete Modal -->
<div class="modal fade" id="deleteModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Apakah Anda Yakin akan Menghapus Data ini?
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{route('admin.sistemoperasi.hapus')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Hapus</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- Modal Tambah User --}}
<div class="modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <center> <b>User Baru</b> </center>

                <form method="POST" id="passFormNewUser" action="{{route('admin.manajemenuser.proses-tambah')}}">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama "
                            required>

                        @if ($errors->has('nama'))
                        <div class="text-danger">
                            {{ $errors->first('nama')}}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Alamat E-Mail"
                            required>

                        @if ($errors->has('email'))
                        <div class="text-danger">
                            {{ $errors->first('email')}}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Unit</label>
                        <select name="unit" width="100%" required class="form-control select1">
                            <option value hidden disable>---Pilih---</option>
                            @foreach($unit as $u)
                            <option value="{{$u->id}}">{{$u->keterangan}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Level</label>
                        <select name="level" width="100%" required class="form-control select2">
                            <option value hidden disable>---Pilih---</option>
                            @foreach($level as $l)
                            <option value="{{$l->id}}">{{$l->keterangan}}</option>
                            @endforeach
                        </select>
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
{{-- Akhir Tambah User --}}

{{-- Modal - Edit User --}}
@foreach ($users as $user)
<div class="modal fade" id="#editModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Edit <b> {{$user->name}}</b>
            </div>
            <div class="modal-footer">
                <form method="POST" action="">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama "
                            required>

                        @if ($errors->has('nama'))
                        <div class="text-danger">
                            {{ $errors->first('nama')}}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Alamat E-Mail"
                            required>

                        @if ($errors->has('email'))
                        <div class="text-danger">
                            {{ $errors->first('email')}}
                        </div>
                        @endif
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Unit</label>
                        </div>
                        <select name="unit" width="100%" required class="form-control select2">
                            <option value hidden disable>---Pilih---</option>
                            {{-- @foreach($unit as $s) --}}
                            <option value="1">Bantaian</option>
                            {{-- @endforeach --}}
                        </select>
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Level</label>
                        </div>
                        <select name="level" width="100%" required class="form-control select2">
                            <option value hidden disable>---Pilih---</option>
                            @foreach($level as $l)
                            <option value="{{$l->id}}">{{$l->keterangan}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="new_password">Password (Min. 8 Digit)</label>
                        <input type="password" name="new_password" class="form-control" placeholder="Password Baru"
                            required> @if ($errors->has('new_password'))
                        <div class="text-danger">
                            {{ $errors->first('new_password')}}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="konfirmasi_password">Konfirmasi Password (Min. 8 Digit)</label><span
                            id='message'></span>
                        <input type="password" name="konfirmasi_password" class="form-control"
                            placeholder="Konfirmasi Password" required> @if ($errors->has('konfirmasi_password'))
                        <div class="text-danger">
                            {{ $errors->first('konfirmasi_password')}}
                        </div>
                        @endif
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <input disabled="disabled" type="submit" class="btn btn-success" value="Simpan">
            </div>
            </form>

        </div>
    </div>
</div>
@endforeach
{{-- Akhir Modal Edit User --}}

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
