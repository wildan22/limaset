@extends('layouts.sidebar')
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">

<!-- Select2 -->
<link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection

@section('page_title','Data Master - Jenis Perangkat')

@section('content-header')
<h3 class="text-center">Data Master Jenis Perangkat</h3>
@endsection

@section('content-main')
<!-- /.card-header -->
<div class="card">
    <div class="card-body">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahDataModal">
            Tambah Data
        </button>
        <table id="jenisperangkat" class="table table-bordered table-hover">
        @php
            $no = 1;
        @endphp
            <thead>
                <tr>
                    <th width="5%">No. </th>
                    <th width="30%">Jenis Perangkat</th>
                    <th width="20%">Kategori</th>
                    <th width="5%">Kode</th>
                    <th width="15%">Updated At</th>
                    <th width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jenisperangkat as $j)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$j->nama_perangkat}}</td>
                    <td>{{$j->category->category_name}}</td>
                    <td>{{$j->kode_inventaris}}</td>
                    <td>{{$j->updated_at}}</td>
                    <td class="text-center">
                        <a class="btn btn-warning text-white" data-toggle="modal" data-target="#editModal-{{$j->id}}">
                            <i class="fas fa-edit"></i>
                        </a>
                        -
                        <a class="btn btn-danger text-white" data-toggle="modal" data-target="#deleteModal-{{$j->id}}">
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
<div class="modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.jenisperangkat.tambah')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Kategori</label>
                        <select class="form-control select2" name="kategori_id" data-placeholder="Kategori" required>
                            <option value hidden disable></option>
                            @foreach($kategori as $k)
                            <option value="{{$k->id}}">{{$k->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jenisperangkat">Jenis Perangkat</label>
                        <input type="text" name="jenisperangkat" class="form-control" placeholder="Misal : PRINTER"
                            aria-describedby="helpId" required>
                    </div>
                    <div class="form-group">
                        <label for="">Kode Inventaris</label>
                        <input type="text" name="kodeinventaris" class="form-control" placeholder="Misal : PRNTR"
                            aria-describedby="helpId" required>
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

@foreach ($jenisperangkat as $j)
<!-- Delete Modal -->
<div class="modal fade" id="deleteModal-{{$j->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Apakah Anda Yakin akan Menghapus <b>{{$j->nama_perangkat}}</b> ?
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{route('admin.jenisperangkat.hapus')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$j->id}}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Hapus</a>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal-{{$j->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ubah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.jenisperangkat.ubah')}}" method="POST">
                    @csrf
                      <div class="form-group">
                          <label for="jenisperangkat">Jenis Perangkat</label>
                          <input type="text" name="jenisperangkat" class="form-control" placeholder="{{$j->nama_perangkat}}" aria-describedby="helpId" required>
                      </div>
                      <div class="form-group">
                        <label for="kodeinventaris">Kode Inventaris</label>
                        <input type="text" name="kodeinventaris" class="form-control" placeholder="Misal : PRNTR" aria-describedby="helpId" required>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="{{$j->id}}" required>
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
    <script src="../../plugins/select2/js/select2.js"></script>
    <script>
        $(function () {
            $('#jenisperangkat').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
            //SELECT2
            $('.select2').select2({
                placeholder: function () {
                    $(this).data('placeholder');
                }
            });
        });
    </script>
@endsection