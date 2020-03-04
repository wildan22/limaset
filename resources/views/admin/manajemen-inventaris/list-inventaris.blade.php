@extends('layouts.sidebar')
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endsection

@section('page_title','List User Terdaftar')

@section('content-header')
<h3 class="text-center">List Inventaris TI</h3>
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
        <table id="listInventaris" class="table table-bordered table-hover">
            @php
            $no = 1;
            @endphp
            <thead>
                <tr>
                    <th width="5%">No. </th>
                    <th width="15%">Jenis</th>
                    <th width="15%">Merek</th>
                    <th width="12%">Kondisi</th>
                    <th width="12%">Tahun</th>
                    <th width="35%">No. Inventaris</th>
                    <th width="5">Detail</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($users as $user) --}}
                <tr>
                    {{-- <td>{{$no++}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->level->keterangan}}</td>
                    <td>{{$user->unit->alias}}</td> --}}
                    <td>1</td>
                    <td>Laptop</td>
                    <td>Omen</td>
                    <td>Baru</td>
                    <td>2020</td>
                    <td>JR/PTPN7/INV/LP/299/X/12</td>
                    <td class="text-center">
                        <a class="btn btn-warning text-white" data-toggle="modal" data-target="#modalDetail">
                            <i class="fas fa-search"></i>
                        </a>
                    </td>
                </tr>
                {{-- @endforeach --}}

            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

{{-- Modal - Detail Inventaris --}}
{{-- @foreach ($users as $user) --}}
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <b> JR/PTPN7/INV/LP/299/X/12</b>
            </div>
            
               asdasd

        </div>
    </div>
</div>
{{-- @endforeach --}}
{{-- Akhir Modal Detail Inventaris --}}

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
