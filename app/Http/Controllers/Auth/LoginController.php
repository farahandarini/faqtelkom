<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request; 

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

    protected function redirectTo(){
        if (Auth()->user()->id_role==1){
            return route('admin.dashboard');
        } 
        else if (Auth()->user()->id_role==2){
            return route('userinternal.dashboard');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $input = $request->all();
        $rules=[
            'nik'=>'required',
            'password'=>'required'
        ];
        $this->validate($request, $rules, [
            "nik.required"=>"NIK Harus Diisi",
            "password.required"=>"Password Harus Diisi"
        ]);

        $password = bcrypt($request->password);
        if (Auth()->attempt(array('nik'=>$input['nik'], 'password'=>$input['password']))){
            if (Auth()->user()->id_role==1){
                return redirect()->route('admin.dashboard');
            } else if (Auth()->user()->id_role==2){
                return redirect()->route('userinternal.dashboard');
            }
        } else{
            return redirect()->route('login')->with('error', "NIK atau Password salah" );
            // return redirect()->route('login')->with('error', $password );
        }
    }
}
