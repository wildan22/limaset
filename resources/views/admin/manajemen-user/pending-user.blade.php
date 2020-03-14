@extends('layouts.sidebar')
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<!-- Select2 -->
<link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection

@section('page_title','Manajemen User - List Pending User')

@section('content-header')
<h3 class="text-center">User Menunggu Konfirmasi</h3>
@endsection

@section('content-main')
<!-- /.card-header -->
<div class="card">
    <div class="card-body">
        <!-- Button trigger modal -->
        <table id="jenisram" class="table table-bordered table-hover">
        @php
            $no = 1;
        @endphp
            <thead>
                <tr>
                    <th width="5%">No. </th>
                    <th width="30%">Nama</th>
                    <th width="30%">Email</th>
                    <th width="20%">Unit</th>
                    <th width="15">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendingusers as $user)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->unit->alias}}</td>
                    <td class="text-center">
                        <a class="btn btn-success text-white" data-toggle="modal" data-target="#acceptModal-{{$user->id}}">
                            <i class="fas fa-check-circle"></i>
                        </a>
                        -
                        <a class="btn btn-danger text-white" data-toggle="modal" data-target="#declineModal-{{$user->id}}">
                            <i class="fas fa-times-circle"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

@foreach ($pendingusers as $user)
<!-- Delete Modal -->
<div class="modal fade" id="declineModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Apakah Anda yakin ingin menolak akun ini?
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{route('admin.manajemenuser.pending.tolak')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Hapus</a>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Accept Modal -->
<div class="modal fade" id="acceptModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Setujui Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.manajemenuser.pending.setuju')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <div class="form-group">
                        <label for="levelid">Level</label>
                        <select class="form-control select2" name="levelid" data-placeholder="Level" required>
                            <option value hidden disable></option>
                            @foreach($level as $l)
                            <option value="{{$l->id}}">{{$l->keterangan}}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Ok</a>
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
        $(function() {
            $('#jenisram').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
            $('.select2').select2({
                placeholder: function () {
                    $(this).data('placeholder');
                }
            });
        });
    </script>
@endsection