@extends('layouts.sidebar')
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">

<!-- Select2 -->
<link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
@section('page_title','Manajemen Inventaris - Form Inventaris')

@section('content-header')
<h3 class="text-center">Tambah Data Inventaris Unit {{Auth::user()->unit->alias}}</h3>
<ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
@endsection


@section('content-main')
<!-- /.card-header -->
<form id="tambahinventaris" method="POST" action="{{route('operator.inventaris.tambah')}}">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Primer</h3>
        </div>
        <div class="card-body">
            @csrf
            <div class="form-group">
                <label for="merkperangkat">Merk Perangkat</label><label class="required-field" style="color:red">*</label>
                <input type="text" name="merkperangkat" class="form-control" placeholder="Contoh: ASUS GL503" required>
                @if ($errors->has('merkperangkat'))
                <div class="text-danger">
                    {{ $errors->first('merkperangkat')}}
                </div>
                @endif
            </div>
            <div class="form-group mb-3">
                <label for="jenisperangkat">Jenis Perangkat</label><label class="required-field" style="color:red">*</label>
                <select name="jenisperangkat" class="form-control select2" data-placeholder="Jenis Perangkat" required>
                    <option value hidden disable></option>
                    @foreach($device as $d)
                    <option value="{{$d->id}}">{{$d->nama_perangkat}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="serialnumber">Serial Number</label><label class="required-field" style="color:red">*</label>
                <input type="text" name="serialnumber" class="form-control" placeholder="Contoh: V8MAJ00RA" required>
                @if ($errors->has('serialnumber'))
                <div class="text-danger">
                    {{ $errors->first('serialnumber')}}
                </div>
                @endif
            </div>
            <div class="form-group mb-3">
                <label for="kondisi">Kondisi Barang</label><label class="required-field" style="color:red">*</label>
                <select name="kondisi" class="form-control select2" data-placeholder="Kondisi Barang" required>
                    <option value hidden disable></option>
                    <option value="BAIK">Baik</option>
                    <option value="KURANG BAIK">Kurang Baik</option>
                    <option value="RUSAK">Rusak</option>
                </select>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label><label class="required-field" style="color:red">*</label>
                <input type="text" name="keterangan" class="form-control" placeholder="Contoh: PST" required>
                @if ($errors->has('keterangan'))
                <div class="text-danger">
                    {{ $errors->first('keterangan')}}
                </div>
                @endif
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><input id="optional-condition" name="optionalcondition" type="checkbox" value="1" checked> Spesifikasi</h3>
        </div>
        <div class="card-body" id="optionalform">
            <div class="form-group">
                <label for="processor">Processor</label><label class="required-field" style="color:red">*</label>
                <input type="text" name="processor" class="form-control" placeholder="Contoh: Intel Core i3 7700HQ"
                    required>
                @if ($errors->has('processor'))
                <div class="text-danger">
                    {{ $errors->first('processor')}}
                </div>
                @endif
            </div>

            <div class="form-group">
                <label for="storagesize">Ukuran Penyimpanan</label><label class="required-field" style="color:red">*</label>
                <div class="input-group">
                    <input type="number" name="storagesize" class="form-control live-convert" placeholder="Contoh: 1000" required>
                    <div class="input-group-append">
                        <span class="input-group-text">GB</span>
                    </div>
                </div>
                @if ($errors->has('storagesize'))
                <div class="text-danger">
                    {{ $errors->first('storagesize')}}
                </div>
                @endif
                <small class="form-text text-muted">Converted Size : <a class="converted-val"></a></small>
            </div>

            <div class="form-group">
                <label for="ramsize">Size RAM</label><label class="required-field" style="color:red">*</label>
                <div class="input-group">
                    <input type="number" name="ramsize" class="form-control" placeholder="Contoh: 1" required>
                    <div class="input-group-append">
                        <span class="input-group-text">GB</span>
                    </div>
                </div>
                @if ($errors->has('ramsize'))
                <div class="text-danger">
                    {{ $errors->first('ramsize')}}
                </div>
                @endif
            </div>
            <div class="form-group mb-3">
                <label for="ramtype">Jenis RAM</label><label class="required-field" style="color:red">*</label>
                <select name="ramtype" id="ramtype" class="form-control select2" data-placeholder="Jenis RAM" required>
                    <option value hidden disable></option>
                    @foreach($ramtype as $rt)
                    <option value="{{$rt->id}}">{{$rt->tipe_ram}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group mb-3">
                <label for="sistemoperasi">Sistem Operasi</label><label class="required-field" style="color:red">*</label>
                <select name="sistemoperasi" id="sistemoperasi" class="form-control select2" data-placeholder="Sistem operasi" required>
                    <option value hidden disable></option>
                    @foreach($operatingsystem as $os)
                    <option value="{{$os->id}}">{{$os->os_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="computername">Computer Name</label>
                <input type="text" name="computername" class="form-control" placeholder="Contoh: N7-KANDIR-WILDAN">
                @if ($errors->has('computername'))
                <div class="text-danger">
                    {{ $errors->first('computername')}}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="wifimac">Wi-Fi Mac Adress</label><label class="required-field" style="color:red">*</label>
                <input type="text" name="wifimac" class="form-control" placeholder="Contoh: B4-D5-BD-F4-AB-19" required>
                @if ($errors->has('wifimac'))
                <div class="text-danger">
                    {{ $errors->first('wifimac')}}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="lanmac">LAN Mac Adress</label><label class="required-field" style="color:red">*</label>
                <input type="text" name="lanmac" class="form-control" placeholder="Contoh: 18-60-24-87-21-13" required>
                @if ($errors->has('lanmac'))
                <div class="text-danger">
                    {{ $errors->first('lanmac')}}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="tahunoleh">Tahun Perolehan</label><label class="required-field" style="color:red">*</label>
                <input type="text" name="tahunoleh" class="form-control" placeholder="Contoh: 2020" required>
                @if ($errors->has('tahunoleh'))
                <div class="text-danger">
                    {{ $errors->first('tahunoleh')}}
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group mt-3">
        <input id="simpanBtn" type="submit" class="btn btn-success" value="Simpan">
    </div>
</form>

@endsection

@section('javascript')
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="../../plugins/select2/js/select2.js"></script>
<script>
    $(function () {
        //SELECT2
        $('.select2').select2({
            placeholder: function () {
                $(this).data('placeholder');
            }
        });
        //Datatable
        $('#jenisram').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
        $('#optional-condition').click(function(){
            $condition = $(this).val();            
            if($condition == "1"){
                $(this).val("0");
                $("#optionalform input").prop('disabled', true);
                $("#optionalform input").prop('required', false);
                $("#ramtype").prop('disabled',true);
                $("#sistemoperasi").prop('disabled',true);
                $("#ramtype").prop('required',false);
                $("#sistemoperasi").prop('required',false);
                $("#optionalform .required-field").text("");
            }
            else{
                $(this).val("1");
                $("#optionalform input").prop('disabled', false);
                $("#optionalform input").prop('required', true);
                $("#ramtype").prop('disabled',false);
                $("#sistemoperasi").prop('disabled',false);
                $("#ramtype").prop('required',true);
                $("#sistemoperasi").prop('required',true);
                //$(".required-field").text("*");
                $("#optionalform .required-field").text("*");
            }
        });
        $(".live-convert").keyup(function(){
            $pos = $(this).index();
            $val = $(this).val();
            if($val >= 1000){
                $(".converted-val").eq($pos).text($val/1000+" TB");
            }
            else{
                $(".converted-val").eq($pos).text($val+" GB");
            }            
        });
        
    });

</script>
@endsection