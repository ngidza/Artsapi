<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LaboratoryLoginController extends Controller
{

    use AuthenticatesUsers;

    public function __construct(){
        $this -> middleware('guest:lab', ['except'=>['logout']]);
    }
    public function showLoginForm(){
        
        return view('auth.lab-login');
    }

    public function login(Request $request){
            //validate
        $this ->validate($request,[
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);
            //attempt to login the  user in
        if(Auth::guard('lab')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember)) {
            //successfully then redirect to the intented location
            return redirect()->intended(route('lab.dashboard'));
        }
            //if unsuccessully rediret back
            return redirect()->back()->withInput($request->only('email','remember'));
    }
    public function logout()
    {
        Auth::guard('lab')->logout();

        return redirect('/');
    }
}
