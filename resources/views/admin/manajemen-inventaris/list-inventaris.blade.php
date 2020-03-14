@extends('layouts.sidebar')
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endsection

@section('page_title','Manajemen Inventaris - List Inventaris')

@section('content-header')
<h3 class="text-center">List Inventaris</h3>
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
            <?php $no=1 ?>
            <thead>
                <tr>
                    <th width="5%">No. </th>
                    <th width="15%">Jenis</th>
                    <th width="15%">Merek</th>
                    <th width="10%">Kondisi</th>
                    <th width="7%">Tahun</th>
                    <th width="35%">No. Inventaris</th>
                    <th width="5%">Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventaris as $i)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$i->devicetype->nama_perangkat}}</td>
                    <td>{{$i->nama_barang}}</td>
                    <td>
                        @if($i->kondisi == "BAIK")
                        <span class="btn btn-success">BAIK</span>
                        @elseif($i->kondisi == "KURANG BAIK")
                        <span class="badge badge-warning">KURANG BAIK</span>
                        @else
                        <span class="badge badge-danger">RUSAK</span>
                        @endif

                    </td>
                    <td>{{$i->tahun_perolehan}}</td>
                    <td>{{$i->nomor_inventaris}}</td>
                    <td class="text-center">
                    <a class="btn btn-warning text-white" data-toggle="modal" data-target="#modalDetail{{$i->id}}">
                            <i class="fas fa-search"></i>
                        </a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

{{-- Modal - Detail Inventaris --}}
@foreach ($inventaris as $i)
<div class="modal fade" id="modalDetail{{$i->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
               <center> <b> JR/PTPN7/INV/LP/299/X/12</b></center>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-4"><b> Perangkat</div></b>
                    <div class="col-8">{{$i->devicetype->nama_perangkat}}</div>
                  </div>
                <div class="row">
                  <div class="col-4"><b>Merk</div></b>
                  <div class="col-8">{{$i->nama_barang}}</div>
                </div>
                <div class="row">
                    <div class="col-4"><b>Serial Number</div></b>
                    <div class="col-8">{{$i->serial_number}}</div>
                </div>
                <div class="row">
                    <div class="col-4"><b>Sistem Operasi</div></b>
                    <div class="col-8">{{$i->operating_system->os_name}}</div>
                  </div>
                  <div class="row">
                    <div class="col-4"><b>Computer Name</div></b>
                    <div class="col-8">{{$i->computer_name}}</div>
                  </div>
                  <div class="row">
                    <div class="col-4"><b>Storage</div></b>
                    <div class="col-8">{{$i->storage_size}}</div>
                  </div>
                  <div class="row">
                    <div class="col-4"><b>RAM</div></b>
                    <div class="col-8">{{$i->ram_size}}</div>
                  </div>
                  <div class="row">
                    <div class="col-4"><b>Processor</div></b>
                    <div class="col-8">{{$i->processor}}</div>
                  </div>
                  <div class="row">
                    <div class="col-4"><b>Wi-Fi Mac Address</div></b>
                    <div class="col-8">{{$i->wifi_mac}}</div>
                  </div>
                  <div class="row">
                    <div class="col-4"><b>Lan Mac Address</div></b>
                    <div class="col-8">{{$i->lan_mac}}</div>
                  </div>
                  <div class="row">
                    <div class="col-4"><b>Tahun Perolehan</div></b>
                    <div class="col-8">{{$i->tahun_perolehan}}</div>
                  </div>
                  
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
    </div>
</div>
@endforeach
{{-- Akhir Modal Detail Inventaris --}}

@endsection

@section('javascript')
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $(function () {
        $('#listInventaris').DataTable({
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
