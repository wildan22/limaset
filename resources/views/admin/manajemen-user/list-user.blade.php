@extends('layouts.sidebar')
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endsection

@section('page_title','List User Terdaftar')

@section('content-header')
<h3 class="text-center">List User Terdaftar</h3>
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
                        <a class="btn btn-warning text-white" data-toggle="modal" data-target="#editModal-{{$user->id}}">
                            <i class="fas fa-edit"></i>
                        </a>
                        -
                        <a class="btn btn-danger text-white" data-toggle="modal" data-target="#deleteModal-{{$user->id}}">
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
<div class="modal fade" id="deleteModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
@endsection

@section('javascript')
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script>
        $(function() {
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
@endsection