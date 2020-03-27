<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/regist', 'GuestController@showSelfRegist');
Route::post('/regist/proses', 'GuestController@prosesSelfRegist')->name('self.register');


Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::get('/home', 'HomeController@index')->name('home');


Route::middleware('is_admin')->group(function (){
    //TAMPILKAN INDEX/DASHBOARD ADMIN
    Route::get('/admin', 'AdminController@showDashboard')->name('admin.home');
    //TAMPILKAN PROFILE ADMIN
    Route::get('/admin/profile', 'AdminController@showProfile')->name('admin.profile');
    //TAMPILKAN HALAMAN MASTER KATEGORI
    Route::get('/admin/data-master/kategori', 'AdminController@showMasterKategori')->name('admin.kategori');
    //TAMPILKAN HALAMAN MASTER JENIS PERANGKAT
    Route::get('/admin/data-master/jenis-perangkat', 'AdminController@showMasterJenisperangkat')->name('admin.jenisperangkat');
    /** TAMPILKAN HALAMAN MASTER SISTEM OPERASI */
    Route::get('/admin/data-master/sistem-operasi', 'AdminController@showMasterSistemOperasi')->name('admin.sistemoperasi');
    /** TAMPILKAN HALAMAN MASTER JENIS RAM */
    Route::get('/admin/data-master/jenis-ram', 'AdminController@showMasterJenisRam')->name('admin.jenisram');
    /** TAMPILKAN HALAMAN MASTER Ukuran Penyimpanan */
    Route::get('/admin/data-master/ukuran-penyimpanan', 'AdminController@showMasterUkuranPenyimpanan')->name('admin.ukuranpenyimpanan');
    /** TAMPILKAN HALAMAN MASTER UNIT */
    Route::get('/admin/data-master/unit', 'AdminController@showUnit')->name('admin.unit');

    /** TAMPILKAN HALAMAN MANAJEMEN-USER.LIST */
    Route::get('/admin/manajemen-user/list-user', 'AdminController@showManajemenUserList')->name('admin.manajemenuser.list');
    /** TAMPILKAN HALAMAN MANEJEMEN-USER.PENDING-USERS-LIST */
    Route::get('/admin/manajemen-user/pending-user', 'AdminController@showPendingUserList')->name('admin.manajemenuser.pending');


    
    //PROSES TAMBAH KATEGORI
    Route::post('/admin/data-master/kategori/tambah', 'AdminController@simpanKategoriBaru')->name('admin.kategori.tambah');
    //PROSES UBAH KATEGORI
    Route::post('/admin/data-master/kategori/update', 'AdminController@ubahKategori')->name('admin.kategori.ubah');
    //PROSES HAPUS KATEGORI
    Route::post('/admin/data-master/kategori/hapus', 'AdminController@hapusKategori')->name('admin.kategori.hapus');

    /** PROSES TAMBAH JENIS-PERANGKAT */
    Route::POST('/admin/data-master/jenis-perangkat/tambah', 'AdminController@simpanJenisPerangkatBaru')->name('admin.jenisperangkat.tambah');
    /**PROSES UBAH JENIS PERANGKAT */
    Route::POST('/admin/data-master/jenis-perangkat/update', 'AdminController@ubahJenisPerangkat')->name('admin.jenisperangkat.ubah');
    /** PROSES HAPUS JENIS-PERANGKAT */
    Route::POST('/admin/data-master/jenis-perangkat/hapus', 'AdminController@hapusJenisPerangkat')->name('admin.jenisperangkat.hapus');
    
    /** PROSES TAMBAH MASTER.SISTEM-OPERASI */
    Route::POST('/admin/data-master/sistem-operasi/tambah', 'AdminController@simpanSistemOperasiBaru')->name('admin.sistemoperasi.tambah');
    /** PROSES UBAH/UPDATE MASTER.SISTEM-OPERASI */
    Route::POST('/admin/data-master/sistem-operasi/update', 'AdminController@ubahSistemOperasi')->name('admin.sistemoperasi.ubah');
    /** PROSES HAPUS MASTER.SISTEM-OPERASI */
    Route::POST('/admin/data-master/sistem-operasi/hapus', 'AdminController@hapusSistemOperasi')->name('admin.sistemoperasi.hapus');

    /** PROSES TAMBAH MASTER.JENIS-RAM */
    Route::POST('/admin/data-master/jenis-ram/tambah', 'AdminController@simpanJenisRam')->name('admin.jenisram.tambah');
    /** PROSES UBAH/UPDATE MASTER.JENIS-RAM */
    Route::POST('/admin/data-master/jenis-ram/update', 'AdminController@ubahJenisRam')->name('admin.jenisram.ubah');
    /** PROSES HAPUS MASTER.JENIS-RAM */
    Route::POST('/admin/data-master/jenis-ram/hapus', 'AdminController@hapusJenisRam')->name('admin.jenisram.hapus');

    /**PROSES SETUJUI PENDING USER */
    Route::POST('admin/manajemen-user/pending-user/accept', 'AdminController@setujuiUserPending')->name('admin.manajemenuser.pending.setuju');
    /** PROSES TOLAK PENDING USER */
    Route::POST('admin/manajemen-user/pending-user/decline', 'AdminController@tolakUserPending')->name('admin.manajemenuser.pending.tolak');

    /** PROSES TAMBAH USER LEWAT ADMIN PANEL */
    Route::POST('admin/manajemen-user/list-user/tambah','AdminController@tambahUser')->name('admin.manajemenuser.proses-tambah');
    /** PROSES HAPUS USER */
    Route::POST('admin/manajemen-user/list-user/hapus','AdminController@hapusUser')->name('admin.manajemenuser.proses-hapus');
    /** PROSES UBAH DETAIL USER */
    Route::POST('admin/manajemen-user/list-user/edit-detail','AdminController@ubahUserDetail')->name('admin.manajemenuser.proses-edit-detail');
    /** PROSES UBAH PASSWORD USER */
    Route::POST('admin/manajemen-user/list-user/edit-password','AdminController@ubahPasswordUser')->name('admin.manajemenuser.proses-edit-password');

     /** TAMPILKAN HALAMAN LIST INVENTARIS */
     Route::get('/admin/manajemen-inventaris/list-inventaris', 'AdminController@showListInventaris')->name('admin.listinventaris');
     /** TAMPILKAN HALAMAN NEW-INVENTARIS */
     Route::get('/admin/manajemen-inventaris/new-inventaris   ', 'AdminController@showFormNewInventaris')->name('admin.forminventaris');

     /** PROSES TAMBAH DATA INVENTARIS */
     Route::POST('/admin/manajemen-inventaris/new-inventaris/tambah', 'AdminController@tambahInventaris')->name('admin.inventaris.tambah');
    /** PROSES HAPUS DATA INVENTARIS */
    Route::POST('/admin/manajemen-inventaris/hapus', 'AdminController@hapusInventaris')->name('admin.inventaris.hapus');
    /** TAMPILKAN FORM EDIT INVENTARIS */
    Route::POST('/admin/manajemen-inventaris/edit-form', 'AdminController@showFormEditInventaris')->name('admin.inventaris.formedit');
    /** PROSES UBAH DATA INVENTARIS */
    Route::POST('/admin/manajemen-inventaris/edit', 'AdminController@editInventaris')->name('admin.inventaris.edit');
    
    /** PROSES HAPUS DATA UNIT/CABANG */
    Route::POST('admin/data-master/unit/hapus', 'AdminController@hapusUnit')->name('admin.unit.hapus');
    /** PROSES TAMBAH DATA UNIT/CABANG */
    Route::POST('admin/data-master/unit/tambah', 'AdminController@tambahUnit')->name('admin.unit.tambah');
    /** PROSES UBAH DATA UNIT/CABANG */
    Route::POST('admin/data-master/unit/ubah', 'AdminController@ubahUnit')->name('admin.unit.ubah');
    

    /**PROSES UBAH PROFILE PASSWORD */
    Route::POST('admin/profile/ubahpassword', 'AdminController@ubahProfilePassword')->name('admin.profile.ubahpassword');
    /**PROSES UBAH PROFILE DETAIL */
    Route::POST('admin/profile/ubahdetail', 'AdminController@ubahProfileDetail')->name('admin.profile.ubahdetail');
    
     
});

Route::middleware('is_operator')->group(function (){
    //TAMPILKAN HALAMAN PROFILE
    Route::get('/operator/profile', 'OperatorController@showProfile')->name('operator.profile');

    //TAMPILKAN INDEX/DASHBOARD ADMIN
    Route::get('/operator', 'OperatorController@showDashboard')->name('operator.home');
    //TAMPILKAN HALAMAN TAMBAH INVENTARIS
    Route::get('/operator/manajemen-inventaris/new-inventaris', 'OperatorController@showNewInventaris')->name('operator.forminventaris');
    /** TAMPILKAN HALAMAN LIST INVENTARIS */
    Route::get('/operator/manajemen-inventaris/list-inventaris', 'OperatorController@showListInventaris')->name('operator.listinventaris');
    /** TAMPILKAN HALAMAN UBAH DATA INVENTARIS */
    Route::POST('/operator/manajemen-inventaris/edit', 'OperatorController@showFormEditInventaris')->name('operator.inventaris.formedit');

    /** PROSES TAMBAH DATA INVENTARIS */
    Route::POST('/operator/manajemen-inventaris/new-inventaris/tambah', 'OperatorController@tambahInventaris')->name('operator.inventaris.tambah');
    /** PROSES UBAH DATA INVENTARIS */
    Route::POST('/operator/manajemen-inventaris/edit/proses', 'OperatorController@editInventaris')->name('operator.inventaris.prosesubah');
    /** PROSES HAPUS DATA INVENTARIS */
    Route::POST('/operator/manajemen-inventaris/hapus', 'OperatorController@hapusInventaris')->name('operator.inventaris.hapus');
    
    
    /**PROSES UBAH PROFILE PASSWORD */
    Route::POST('operator/profile/ubahpassword', 'OperatorController@ubahProfilePassword')->name('operator.profile.ubahpassword');
    /**PROSES UBAH PROFILE DETAIL */
    Route::POST('operator/profile/ubahdetail', 'OperatorController@ubahProfileDetail')->name('operator.profile.ubahdetail');

});


Route::middleware('is_eksekutif')->group(function (){
    //TAMPILKAN INDEX/DASHBOARD EKSEKUTIF
    Route::get('/eksekutif', 'EksekutifController@showDashboard')->name('eksekutif.home');
    //TAMPILKAN HALAMAN LIST INVENTARIS EKSEKUTIF
    Route::get('/eksekutif/list-inventaris', 'EksekutifController@showInventarisList')->name('eksekutif.inventarislist');
    //TAMPILKAN HALAMAN PROFILE EKSEKUTIF
    Route::get('/eksekutif/profile', 'EksekutifController@showProfile')->name('eksekutif.profile');
    /**PROSES UBAH PROFILE PASSWORD EKSEKUTIF */
    Route::POST('eksekutif/profile/ubahpassword', 'EksekutifController@ubahProfilePassword')->name('eksekutif.profile.ubahpassword');
    /**PROSES UBAH PROFILE DETAIL EKSEKUTIF */
    Route::POST('eksekutif/profile/ubahdetail', 'EksekutifController@ubahProfileDetail')->name('eksekutif.profile.ubahdetail');
});

//-- HANYA UNTUK TESTING --//
Route::get('/lihatsession','GuestController@tampilkanSession');
//-- HANYA UNTUK TESTING --//
