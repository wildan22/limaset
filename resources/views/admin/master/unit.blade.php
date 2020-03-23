@extends('layouts.sidebar')
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endsection

@section('page_title','Manajemen User - List User')

@section('content-header')
<h3 class="text-center">List Unit</h3>
<ul>
    {{-- @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach --}}
</ul>
@endsection

@section('content-main')
<!-- /.card-header -->
<div class="card">
    <div class="card-body">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahDataModal">
            Tambah Unit
        </button>
        <table id="jenisram" class="table table-bordered table-hover">
            @php
            $no = 1;
            @endphp
            <thead>
                <tr>
                    <th width="5%">No. </th>
                    <th width="30%">Nama Unit</th>
                    <th width="20%">Alias</th>
                    <th width="15%">Created At</th>                    
                    <th width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($units as $unit)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$unit->keterangan}}</td>
                    <td>{{$unit->alias}}</td>
                    <td>{{$unit->created_at}}</td>
                    <td class="text-center">
                        <a class="btn btn-warning text-white" data-toggle="modal"
                            data-target="#editModal-{{$unit->id}}">
                            <i class="fas fa-edit"></i>
                        </a>
                        -
                        <a class="btn btn-danger text-white" data-toggle="modal"
                            data-target="#deleteModal-{{$unit->id}}">
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

@foreach ($units as $unit)
<!-- Delete Unit Modal -->
<div class="modal fade" id="deleteModal-{{$unit->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Apakah Anda Yakin akan Menghapus Unit {{$unit->keterangan}} ini?
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{route('admin.unit.hapus')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$unit->id}}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Hapus</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- Modal Tambah Unit --}}
<div class="modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <center> <b>Unit Baru</b> </center>
                <form method="POST" id="passFormNewUser" action="{{route('admin.unit.tambah')}}">
                    @csrf
                    <div class="form-group">
                        <label for="namaunit">Nama Unit</label>
                        <input type="text" name="namaunit" class="form-control" placeholder="Contoh: Bunga Mayang"
                            required>

                        @if ($errors->has('namaunit'))
                        <div class="text-danger">
                            {{ $errors->first('namaunit')}}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="inisialunit">Inisial Unit</label>
                        <input type="text" name="inisialunit" class="form-control" placeholder="Contoh: BUMA"
                            required>

                        @if ($errors->has('inisialunit'))
                        <div class="text-danger">
                            {{ $errors->first('inisialunit')}}
                        </div>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <input id="simpanBtnNew" type="submit" class="btn btn-success"
                            value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Akhir Tambah Unit --}}

{{-- Modal - Edit Unit --}}
@foreach ($units as $unit)
<div class="modal fade" id="editModal-{{$unit->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Edit <b>{{$unit->keterangan}}</b>
                
                <form method="POST" action="{{route('admin.unit.ubah')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$unit->id}}">

                    <div class="form-group">
                        <label for="namaunit">Nama Unit</label>
                        <input type="text" name="namaunit" class="form-control" placeholder="{{$unit->keterangan}}"
                            required>

                        @if ($errors->has('namaunit'))
                        <div class="text-danger">
                            {{ $errors->first('namaunit')}}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="inisialunit">Inisial Unit</label>
                        <input type="text" name="inisialunit" class="form-control" placeholder="{{$unit->alias}}"
                            required>

                        @if ($errors->has('inisialunit'))
                        <div class="text-danger">
                            {{ $errors->first('inisialunit')}}
                        </div>
                        @endif
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <input type="submit" class="btn btn-success" value="Simpan">
            </div>
            </form>

        </div>
    </div>
</div>
@endforeach
{{-- Akhir Modal Edit Unit --}}

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
