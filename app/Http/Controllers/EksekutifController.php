<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;

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

class EksekutifController extends Controller{
    /** TAMPILKAN HALAMAN DASHBOARD */
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
        return view('eksekutif.index',['baik'=>$barangbaik,'kurangbaik'=>$barangkurangbaik,'rusak'=>$barangrusak,'tahunbarang'=>$tahunbarang,'datacabang'=>$datacabang,'databarang'=>$databarang]);
    }

    /** TAMPILKAN HALAMAN LIST INVENTARIS UNTUK EKSEKUTIF */
    public function showInventarisList(){
        $inventaris = goods::where('unit_id',Auth::user()->unit_id)->get();
        return view('eksekutif.list-inventaris',['inventaris'=>$inventaris]);
    }

    /** TAMPILKAN HALAMAN PROFILE */
    public function showProfile(){
        $profile = User::find(Auth::user()->id);
        return view('eksekutif.profile',['profile'=>$profile]);
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
        return redirect()->route('eksekutif.profile');
    }
}

?>