<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use DB;
use App\goods;
use App\requested_user;
use App\unit;
use App\category;
use App\device_type;
use App\ram_type;
use App\operating_system;
use App\User;
use Illuminate\Validation\Rule;


class OperatorController extends Controller{
    public function showDashboard(){
        $barangbaik = goods::where('kondisi','BAIK')->where('unit_id',Auth::user()->unit_id)->count();
        $barangkurangbaik = goods::where('kondisi','KURANG BAIK')->where('unit_id',Auth::user()->unit_id)->count();
        $barangrusak = goods::where('kondisi','RUSAK')->where('unit_id',Auth::user()->unit_id)->count();
        $tahunbarang = DB::table('goods')
                ->select('tahun_perolehan')
                ->where('unit_id',Auth::user()->unit_id)
                ->whereNotNull('tahun_perolehan')
                ->distinct()
                ->orderBy('tahun_perolehan', 'asc')
                ->get();
        $datacabang = unit::where('id',Auth::user()->unit_id)->get();
        $databarang = goods::where('unit_id',Auth::user()->unit_id)->get();
        return view('operator.index',['baik'=>$barangbaik,'kurangbaik'=>$barangkurangbaik,'rusak'=>$barangrusak,'tahunbarang'=>$tahunbarang,'datacabang'=>$datacabang,'databarang'=>$databarang]);
    }

    /** Tampilkan Halaman Profile Admin */
    public function showProfile(){
        $profile = User::find(Auth::user()->id);
        return view('operator.profile',['profile'=>$profile]);
    }

    public function showNewInventaris(){
        $category = category::all();
        $device = device_type::all();
        $ramtype = ram_type::all();
        $operatingsystem = operating_system::all();
        return view('operator.manajemen-inventaris.new-inventaris',['category'=>$category,'device'=>$device,'ramtype'=>$ramtype,'operatingsystem'=>$operatingsystem]);
    }

    public function showListInventaris(){
        $inventaris = goods::where('unit_id',Auth::user()->unit_id)->get();
        return view('operator.manajemen-inventaris.list-inventaris',['inventaris'=>$inventaris]);
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
                'operating_system_id' => $request->sistemoperasi,
                'computer_name' => $request->computername,
                'wifi_mac' => $request->wifimac,
                'lan_mac' => $request->lanmac,
                'kondisi' => $request->kondisi,
                'tahun_perolehan' => $request->tahunoleh,
                'keterangan' => $request->keterangan,
                'unit_id' => Auth::user()->unit_id,
                'created_by' => Auth::user()->id
            ]);
            $device_code = device_type::find($tambahinventaris->device_type_id);
            $generate = goods::find($tambahinventaris->id);
            $generate->nomor_inventaris="RJ/PTPN7/INV/".$device_code->kode_inventaris."/".$tambahinventaris->id."/".$tambahinventaris->tahun_perolehan;
            $generate->save();
            Alert::success('Sukses','Data Inventaris Berhasil Ditambahkan');
            return redirect()->route('operator.listinventaris');
        }
        else{
            $this->validate($request,[
                'merkperangkat' => 'required|min:3',
                'jenisperangkat' => 'required|min:1',
                'serialnumber' => 'required|min:1',
                'kondisi' => 'required|min:3',
                'keterangan' => 'required|min:3',
            ]);
            $tambahinventaris = goods::create([
                'device_type_id' => $request->jenisperangkat,
                'nama_barang' => $request->merkperangkat,
                'serial_number' => $request->serialnumber,
                'kondisi' => $request->kondisi,
                'keterangan' => $request->keterangan,
                'unit_id' => Auth::user()->unit_id,
                'created_by' => Auth::user()->id,
                'operating_system_id' => 14
            ]);
            Alert::success('Sukses','Data Inventaris Berhasil Ditambahkan');
            return redirect()->route('operator.listinventaris');
        }
    }

    /** TAMPILKAN HALAMAN EDIT INVENTARIS */
    public function showFormEditInventaris(Request $request){
        $this->validate($request,[
            'id'=>'required|min:1'
        ]);
        $goodscount = goods::where('unit_id',Auth::user()->unit_id)->where('id',$request->id)->count();
        if($goodscount != 0){
            $category = category::all();
            $device = device_type::all();
            $ramtype = ram_type::all();
            $operatingsystem = operating_system::all();
            $inventaris = goods::find($request->id);
            $inventaris->where('unit_id',Auth::user()->unit_id);
            $inventaris->get();
            return view('operator.manajemen-inventaris.edit-inventaris',[
                'inventaris'=>$inventaris,
                'category'=>$category,
                'device'=>$device,
                'ramtype'=>$ramtype,
                'operatingsystem'=>$operatingsystem,
            ]);
        }
        else{
            Alert::error('Gagal','Data yang anda cari tidak ada');
            return redirect()->route('operator.listinventaris');
        }
    }

    /** PROSES EDIT INVENTARIS */
    public function editInventaris(Request $request){
        if($request->optionalcondition == 1){
            $this->validate($request,[
                'id' => 'required|min:1',
                'merkperangkat' => 'required|min:3',
                'jenisperangkat' => 'required|min:1',
                'serialnumber' => 'required|min:1',
                'kondisi' => 'required|min:3',
                'keterangan' => 'required|min:3',
                
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
            $ubahinventaris = goods::where('id',$request->id)
                            ->where('unit_id',Auth::user()->unit_id)
                            ->update([
                                'device_type_id' => $request->jenisperangkat,
                                'nama_barang' => $request->merkperangkat,
                                'serial_number' => $request->serialnumber,
                                'processor' => $request->processor,
                                'storage_size' => $request->storagesize,
                                'ram_size' => $request->ramsize,
                                'ram_type_id' => $request->ramtype,
                                'storage_size' => $request->storagesize,
                                'operating_system_id' => $request->sistemoperasi,
                                'computer_name' => $request->computername,
                                'wifi_mac' => $request->wifimac,
                                'lan_mac' => $request->lanmac,
                                'kondisi' => $request->kondisi,
                                'tahun_perolehan' => $request->tahunoleh,
                                'keterangan' => $request->keterangan,
                                'created_by' => Auth::user()->id
                            ]);
        }
        else{
            $this->validate($request,[
                'merkperangkat' => 'required|min:3',
                'jenisperangkat' => 'required|min:1',
                'serialnumber' => 'required|min:1',
                'kondisi' => 'required|min:3',
                'keterangan' => 'required|min:3',
            ]);
            $ubahinventaris = goods::where('id',$request->id)
                            ->where('unit_id',Auth::user()->unit_id)
                            ->update([
                                'device_type_id' => $request->jenisperangkat,
                                'nama_barang' => $request->merkperangkat,
                                'serial_number' => $request->serialnumber,
                                'kondisi' => $request->kondisi,
                                'keterangan' => $request->keterangan,
                                'created_by' => Auth::user()->id,
                                'operating_system_id' => 14
                            ]);
        }
        if($ubahinventaris==1){
            Alert::success('Sukses','Data Berhasil Diubah');
            return redirect()->route('operator.listinventaris');
        }
        else{
            Alert::warning('Gagal','Data Gagal Diubah');
            return redirect()->route('operator.listinventaris');
        }
    }

    /** PROSES HAPUS INVENTARIS */
    public function hapusInventaris(Request $request){
        $this->validate($request,[
            'id'=>'required|min:1'
        ]);
        $inventaris = goods::find($request->id);
        $inventaris->where('unit_id',Auth::user()->unit_id);
        $inventaris->delete();
        Alert::success('Sukses','Data Berhasil Dihapus');
        return redirect()->route('operator.listinventaris');
    }

    /** PROSES UBAH PASSWORD MELALUI PROFIL */
    public function ubahProfilePassword(Request $request){
        $this->validate($request,[
            'password' => 'required|min:8|confirmed'
        ]);
        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($request->password);
        $user->save();
        $request->session()->flush();
        Alert::success('Sukses','Password Berhasil Diubah, silahkan login kembali');
        return redirect()->route('login');
    }

    /** PROSES UBAH DETAIL USER MELALUI PROFIL */
    public function ubahProfileDetail(Request $request){
        $this->validate($request,[
            'nama' => 'required|min:3',
            'email'=>['required','min:3','email',Rule::unique('users')->ignore(Auth::user()->id)],
        ]);
        $user = User::find(Auth::user()->id);
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->save();
        Alert::success('Sukses','Profile Berhasil diubah');
        return redirect()->route('operator.profile');
    }
}
?>