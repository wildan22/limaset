@extends('layouts.sidebar')
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endsection

@section('page_title','Data Master - Ukuran Penyimpanan')

@section('content-header')
<h3 class="text-center">Data Master Ukuran Penyimpanan</h3>
@endsection

@section('content-main')
<!-- /.card-header -->
<div class="card">
    <div class="card-body">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahDataModal">
            Tambah Data
        </button>
        <table id="jenisram" class="table table-bordered table-hover">
        @php
            $no = 1;
        @endphp
            <thead>
                <tr>
                    <th width="5%">No. </th>
                    <th width="30%">Tipe Ram</th>
                    <th width="20%">Created At</th>
                    <th width="20%">Updated At</th>
                    <th width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jenisram as $jr)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$jr->tipe_ram}}</td>
                    <td>{{$jr->created_at}}</td>
                    <td>{{$jr->updated_at}}</td>
                    <td class="text-center">
                        <a class="btn btn-warning text-white" data-toggle="modal" data-target="#editModal-{{$jr->id}}">
                            <i class="fas fa-edit"></i>
                        </a>
                        -
                        <a class="btn btn-danger text-white" data-toggle="modal" data-target="#deleteModal-{{$jr->id}}">
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
<!-- Modal -->
<div class="modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Jenis Ram</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.jenisram.tambah')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Jenis Ram</label>
                        <input type="text" name="jenisram" class="form-control" placeholder="Misal : DDR3" aria-describedby="helpId" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach ($jenisram as $jr)
<!-- Delete Modal -->
<div class="modal fade" id="deleteModal-{{$jr->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Apakah Anda Yakin akan Menghapus Data ini?
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{route('admin.jenisram.hapus')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$jr->id}}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Hapus</a>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal-{{$jr->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ubah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.jenisram.ubah')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$jr->id}}">
                    <div class="form-group">
                        <label for="">Jenis Ram</label>
                        <input type="text" name="jenisram" class="form-control" placeholder="Misal : DDR3" aria-describedby="helpId" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Edit</a>
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