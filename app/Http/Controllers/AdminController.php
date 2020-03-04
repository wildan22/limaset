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

class AdminController extends Controller
{
    /** Tampilkan Halaman Dashboard */
    public function showDashboard(){
        return view('admin.index');
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
        $list = requested_user::all();
        return view('admin.manajemen-inventaris.list-inventaris',['list'=>$list]);
    }

      /** Tampilkan Halaman Manajemen-Inventaris.new-Inventaris */
      public function showFormNewInventaris(){
        return view('admin.manajemen-inventaris.new-inventaris');
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
            'jenisperangkat' => 'required|min:3'
        ]);
        device_type::create([
            'category_id' => $request->kategori_id,
            'nama_perangkat' => $request->jenisperangkat
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
            'jenisperangkat' => 'required|min:3'
        ]);
        $jenisperangkat = device_type::find($request->id);
        $jenisperangkat->nama_perangkat=$request->jenisperangkat;
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
}
