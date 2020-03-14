<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\goods;
use App\requested_user;
use App\unit;

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
}


?>