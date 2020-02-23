<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\requested_user;
use Validator;
use Auth;

class GuestController extends Controller
{
    public function showSelfRegist(){
        return view('self-regist');
    }

    public function prosesSelfRegist(Request $request){
        $this->validate($request,[
            'name' => 'required|min:3|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'unit' => 'required'
        ]);
        
        requested_user::create([
    		'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'unit_id' => $request->unit
        ]);
        
        return redirect('/login');
    }

    public function tampilkanSession(Request $request) {
        if($request->session()->has('level')){
            echo 'Level : '.$request->session()->get('level').'<br>';
            echo 'Units : '.$request->session()->get('units').'<br>';
            echo 'User ID : '.Auth::id();
        }else{
            echo 'Tidak ada data dalam session.';
        }
    }
}
