<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\goods;
use App\requested_user;
use App\unit;
use App\category;
use App\device_type;
use App\ram_type;
use App\operating_system;

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
}
?>