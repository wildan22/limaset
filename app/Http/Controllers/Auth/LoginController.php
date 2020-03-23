<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {   
        $input = $request->all();
        $message = [
            'captcha'=>'Captcha yang anda masukan salah'
        ];
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ],$message);
   
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {

            //CONDITION JIKA USER MERUPAKAN ADMIN
            if (auth()->user()->level_id == 1) {
                session()->put('level',1);
                session()->put('units',auth()->user()->unit_id);
                return redirect()->route('admin.home');
            }

            //CONDITION JIKA USER MERUPAKAN OPERATOR
            elseif (auth()->user()->level_id == 2){
                session()->put('level',2);
                session()->put('units',auth()->user()->unit_id);
                return redirect()->route('operator.home');
            }

            //CONDITION JIKA USER MERUPAKAN EKSEKUTIF
            elseif(auth()->user()->level_id == 3){
                session()->put('level',3);
                session()->put('units',auth()->user()->unit_id);
                return redirect()->route('eksekutif.home');
            }
        }else{
            return redirect()->route('login')
                ->with('error','Alamat Email atau Password Anda Salah!');
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();
        Alert::success('Sukses','Berhasil Keluar');
        return redirect('/login');
    }
}
