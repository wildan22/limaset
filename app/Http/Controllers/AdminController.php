<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use RealRashid\SweetAlert\Facades\Alert;
use App\device_type;
use App\operating_system;
use App\ram_type;
use App\User;
use App\requested_user;
use App\level;
use App\unit;
use App\storage_size;
use App\goods;
use DB;
use Auth;

class AdminController extends Controller
{
    /** Tampilkan Halaman Dashboard */
    public function showDashboard(){
        $barangbaik = goods::where('kondisi','BAIK')->count();
        $barangkurangbaik = goods::where('kondisi','KURANG BAIK')->count();
        $barangrusak = goods::where('kondisi','RUSAK')->count();
        $pendinguser = requested_user::count();
        $tahunbarang = DB::table('goods')
                ->select('tahun_perolehan')
                ->whereNotNull('tahun_perolehan')
                ->distinct()
                ->orderBy('tahun_perolehan', 'asc')
                ->get();
        $datacabang = unit::all();
        $databarang = goods::all();
        return view('admin.index',['baik'=>$barangbaik,'kurangbaik'=>$barangkurangbaik,'rusak'=>$barangrusak,'pendinguser'=>$pendinguser,'tahunbarang'=>$tahunbarang,'datacabang'=>$datacabang,'databarang'=>$databarang]);
    }

    /** Tampilkan Halaman Master.Kategori */
    public function showMasterKategori(){
        $kategori = category::all();
        return view('admin.master.kategori',['kategori'=>$kategori]);
    }

    /** Tampilkan Halaman Master.Jenis-Perangkat */
    public function showMasterJenisperangkat(){
        $jenisperangkat = device_type::all();
        $kategori = category::all();
        return view('admin.master.jenis-perangkat',['jenisperangkat'=>$jenisperangkat,'kategori'=>$kategori]);
    }

    /** Tampilkan Halaman Master.Sistem-Operasi */
    public function showMasterSistemOperasi(){
        $operatingsystem = operating_system::all();
        return view('admin.master.sistem-operasi',['operatingsystem'=>$operatingsystem]);
    }

    /** Tampilkan Halaman Master.Jenis-Ram */
    public function showMasterJenisRam(){
        $jenisram = ram_type::all();
        return view('admin.master.jenis-ram',['jenisram'=>$jenisram]);
    }

     /** Tampilkan Halaman Master.Ukuran-Penyimpanan */
     public function showMasterUkuranPenyimpanan(){
        $ukuranpenyimpanan = storage_size::all();
        $kategori = category::all();
        return view('admin.master.ukuran-penyimpanan',['ukuranpenyimpanan'=>$ukuranpenyimpanan,'kategori'=>$kategori]);
    }

    /** Tampilkan Halaman Manajemen-User.List */
    public function showManajemenUserList(){
        $users = User::all();
        $level = level::all();
        $unit = unit::all();
        return view('admin.manajemen-user.list-user',['users'=>$users,'level'=>$level,'unit'=>$unit]);
    }

    /** Tampilkan Halaman Manajemen-User.Pending-User */
    public function showPendingUserList(){
        $pendingusers = requested_user::all();
        $level = level::all();
        return view('admin.manajemen-user.pending-user',['pendingusers'=>$pendingusers,'level'=>$level]);
    }

    /** Tampilkan Halaman Manajemen-Inventaris.List-Inventaris */
    public function showListInventaris(){
        $inventaris = goods::all();
        return view('admin.manajemen-inventaris.list-inventaris',['inventaris'=>$inventaris]);
    }

      /** Tampilkan Halaman Manajemen-Inventaris.new-Inventaris */
      public function showFormNewInventaris(){
        $category = category::all();
        $device = device_type::all();
        $ramtype = ram_type::all();
        $operatingsystem = operating_system::all();
        $units = unit::all();
        return view('admin.manajemen-inventaris.new-inventaris',['category'=>$category,'device'=>$device,'ramtype'=>$ramtype,'operatingsystem'=>$operatingsystem,'units'=>$units]);
    }

    /** Tampilkan Halaman Manajemen-User.Tambah-User */
    public function showTambahUserForm(){
        $users = User::all();
        return view('admin.manajemen-user.tambah-user',['users'=>$users]);
    }

    /** Proses Simpan Kategori Baru */
    public function simpanKategoriBaru(Request $request){
        $this->validate($request,[
            'namakategori'=>'required|min:3'
        ]);
        category::create([
            'category_name' => $request->namakategori
        ]);
        Alert::success('Sukses','Data Berhasil Ditambahkan');
        return redirect()->route('admin.kategori');
    }

    /** Proses Update/Ubah Kategori */
    public function ubahKategori(Request $request){
        $this->validate($request,[
            'namakategori'=>'required|min:3'
        ]);

        $kategori = category::find($request->id);
        $kategori->category_name = $request->namakategori;
        $kategori->save();

        Alert::success('Sukses','Data Berhasil Diperbaharui');
        return redirect()->route('admin.kategori');
    }

    /** Proses Hapus Kategori */
    public function hapusKategori(Request $request){
        $this->validate($request,[
            'id'=>'required'
        ]);
        $kategori = category::find($request->id);
        $kategori->delete();
        Alert::success('Sukses','Data Berhasil Dihapus');
        return redirect()->route('admin.kategori');
    }

    /** Proses Tambah Master.Jenis-Perangkat*/
    public function simpanJenisPerangkatBaru(Request $request){
        $this->validate($request,[
            'kategori_id' => 'required',
            'jenisperangkat' => 'required|min:3',
            'kodeinventaris' => 'required|min:1|unique:device_types,kode_inventaris'
        ]);
        device_type::create([
            'category_id' => $request->kategori_id,
            'nama_perangkat' => $request->jenisperangkat,
            'kode_inventaris' => $request->kodeinventaris
        ]);
        Alert::success('Sukses','Data Berhasil Ditambahkan');
        return redirect()->route('admin.jenisperangkat');
    }

    /**Proses Hapus Master.Jenis-Perangkat */
    public function hapusJenisPerangkat(Request $request){
        $this->validate($request,[
            'id'=>'required'
        ]);
        $jenisperangkat = device_type::find($request->id);
        $jenisperangkat->delete();
        Alert::success('Sukses','Data Berhasil Dihapus');
        return redirect()->route('admin.jenisperangkat');
    }

    /** Proses Update/Ubah Master.Jenis-Perangkat */
    public function ubahJenisPerangkat(Request $request){
        $this->validate($request,[
            'id' =>'required',
            'jenisperangkat' => 'required|min:3',
            'kodeinventaris' => 'required|min:1|unique:device_types,kode_inventaris'
        ]);
        $jenisperangkat = device_type::find($request->id);
        $jenisperangkat->nama_perangkat=$request->jenisperangkat;
        $jenisperangkat->kode_inventaris=$request->kodeinventaris;
        $jenisperangkat->save();
        Alert::success('Sukses','Data Berhasil Diubah');
        return redirect()->route('admin.jenisperangkat');
    }

    /** Proses Tambah Master.Sistem-Operasi */
    public function simpanSistemOperasiBaru(Request $request){
        $this->validate($request,[
            'sistemoperasi' => 'required|min:3'
        ]);
        $sistemoperasi = operating_system::create([
            'os_name' => $request->sistemoperasi
        ]);
        Alert::success('Sukses','Data Berhasil Ditambahkan');
        return redirect()->route('admin.sistemoperasi');
    }

    /** Proses Ubah/Update Master.Sistem-Operasi */
    public function ubahSistemOperasi(Request $request){
        $this->validate($request,[
            'id' => 'required',
            'sistemoperasi' => 'required|min:3'
        ]);
        $sistemoperasi = operating_system::find($request->id);
        $sistemoperasi->os_name=$request->sistemoperasi;
        $sistemoperasi->save();
        Alert::success('Sukses','Data Berhasil Diubah');
        return redirect()->route('admin.sistemoperasi');
    }

    /**Proses Hapus Master.Sistem-Operasi */
    public function hapusSistemOperasi(Request $request){
        $this->validate($request,[
            'id' => 'required'
        ]);
        $sistemoperasi = operating_system::find($request->id);
        $sistemoperasi->delete();
        Alert::success('Sukses','Data Berhasil Dihapus');
        return redirect()->route('admin.sistemoperasi');
    }

    /** Proses Simpan Master.Jenis-Ram */
    public function simpanJenisRam(Request $request){
        $this->validate($request,[
            'jenisram' => 'required|min:3|unique:ram_types,tipe_ram,NULL,id,deleted_at,NULL'
        ]);
        ram_type::create([
            'tipe_ram' => $request->jenisram
        ]);
        Alert::success('Sukses','Data Berhasil Ditambahkan');
        return redirect()->route('admin.jenisram');
    }

    /** Proses Ubah/Update Master.Jenis-Ram */
    public function ubahJenisRam(Request $request){
        $this->validate($request,[
            'id'=>'required',
            'jenisram' => 'required|min:3|unique:ram_types,tipe_ram'
        ]);
        $jenisram = ram_type::find($request->id);
        $jenisram->tipe_ram=$request->jenisram;
        $jenisram->save();
        Alert::success('Sukses','Data Berhasil Diubah');
        return redirect()->route('admin.jenisram');
    }

    /** Proses Hapus Master.Jenis-Ram */
    public function hapusJenisRam(Request $request){
        $this->validate($request,[
            'id'=>'required'
        ]);
        $jenisram = ram_type::find($request->id);
        $jenisram->delete();
        Alert::success('Sukses','Data Berhasil Dihapus');
        return redirect()->route('admin.jenisram');
    }

    /**Proses Setujui Manajemen-User.Pending-User */
    public function setujuiUserPending(Request $request){
        $this->validate($request,[
            'id' => 'required',
            'levelid' => 'required'
        ]);
        $userpending = requested_user::find($request->id);
        User::create([
            'name' => $userpending->name,
            'email' => $userpending->email,
            'level_id' => $request->levelid,
            'unit_id' => $userpending->unit_id,
            'password' => $userpending->password
        ]);
        $userpending->delete();
        Alert::success('Sukses','Users Berhasil Disetujui');
        return redirect()->route('admin.manajemenuser.pending');
    }

    /** Proses Tolak Manajemen-User.Pending-User */
    public function tolakUserPending(Request $request){
        $this->validate($request,[
            'id' => 'required'
        ]);
        $userpending = requested_user::find($request->id);
        $userpending->delete();
        Alert::success('Sukses','Users Berhasil Ditolak');
        return redirect()->route('admin.manajemenuser.pending');
    }

    /** Proses Tambah User */
    public function tambahUser(Request $request){
        $this->validate($request,[
            'nama' => 'required|min:3',
            'email' => 'required|email|min:5|unique:users,email',
            'unit' => 'required',
            'level' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);
        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'level_id' => $request->level,
            'unit_id' => $request->unit,
            'password' => bcrypt($request->password)
        ]);
        Alert::success('Sukses','Users Berhasil Ditambahkan');
        return redirect()->route('admin.manajemenuser.list');
    }

    /** Proses Hapus User */
    public function hapusUser(Request $request){
        $this->validate($request,[
            'id' => 'required'
        ]);
        $sistemoperasi = User::find($request->id);
        $sistemoperasi->delete();
        Alert::success('Sukses','Data Berhasil Dihapus');
        return redirect()->route('admin.manajemenuser.list');
    }

    /**Proses Tambah Data Inventaris */
    public function tambahInventaris(Request $request){
        if($request->optionalcondition == 1){
            $this->validate($request,[
                'merkperangkat' => 'required|min:3',
                'jenisperangkat' => 'required|min:1',
                'serialnumber' => 'required|min:1',
                'kondisi' => 'required|min:3',
                'keterangan' => 'required|min:3',
                'unit' => 'required|min:1',
                
                'processor' => 'required|min:3',
                'storagesize' => ['required','regex:/^(0*[1-9][0-9]*(\.[0-9]+)?|0+\.[0-9]*[1-9][0-9]*)$/'],
                'ramsize' => ['required','regex:/^(0*[1-9][0-9]*(\.[0-9]+)?|0+\.[0-9]*[1-9][0-9]*)$/'],
                'ramtype' => 'required|min:1',
                'sistemoperasi' => 'required|min:1',
                'computername' => 'required|min:1',
                'wifimac' => ['required','regex:/^([0-9A-F]{2}[:-]){5}([0-9A-F]{2})$/'],
                'lanmac' => ['required','regex:/^([0-9A-F]{2}[:-]){5}([0-9A-F]{2})$/'],
                'tahunoleh' => 'required|min:4'
            ],[
                'wifimac.regex' => 'Format Mac Address Tidak Sesuai',
                'lanmac.regex' => 'Format Mac Address Tidak Sesuai'
            ]);
            $tambahinventaris = goods::create([
                'device_type_id' => $request->jenisperangkat,
                'nama_barang' => $request->merkperangkat,
                'serial_number' => $request->serialnumber,
                'processor' => $request->processor,
                'storage_size' => $request->storagesize,
                'ram_size' => $request->ramsize,
                'ram_type_id' => $request->ramtype,
                'storage_size' => $request->storagesize,
                'unit_id' => $request->unit,
                'operating_system_id' => $request->sistemoperasi,
                'computer_name' => $request->computername,
                'wifi_mac' => $request->wifimac,
                'lan_mac' => $request->lanmac,
                'kondisi' => $request->kondisi,
                'tahun_perolehan' => $request->tahunoleh,
                'keterangan' => $request->keterangan,
                'created_by' => Auth::user()->id
            ]);
            $device_code = device_type::find($tambahinventaris->device_type_id);
            $generate = goods::find($tambahinventaris->id);
            $generate->nomor_inventaris="RJ/PTPN7/INV/".$device_code->kode_inventaris."/".$tambahinventaris->id."/".$tambahinventaris->tahun_perolehan;
            $generate->save();
        }
        else{
            $this->validate($request,[
                'merkperangkat' => 'required|min:3',
                'jenisperangkat' => 'required|min:1',
                'serialnumber' => 'required|min:1',
                'kondisi' => 'required|min:3',
                'keterangan' => 'required|min:3',
                'unit' => 'required|min:1',
            ]);
            $tambahinventaris = goods::create([
                'device_type_id' => $request->jenisperangkat,
                'nama_barang' => $request->merkperangkat,
                'serial_number' => $request->serialnumber,
                'kondisi' => $request->kondisi,
                'keterangan' => $request->keterangan,
                'unit_id' => $request->unit,
                'created_by' => Auth::user()->id,
                'operating_system_id' => 14
            ]);
        }
        
    }
}
