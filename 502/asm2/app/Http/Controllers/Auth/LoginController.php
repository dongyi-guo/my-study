<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//sachin(668690)
use Illuminate\Http\Request;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

    //sachin(668690)
    public function index() {
        return view('start.home-login');
    }

    public function validate_login(Request $request) {
        $request->validate([
            'email'       => ['required', 'email'],
            'passwd'    => ['required'],
        ]);

        $user = User::where('email','=',$request->email)->first();
    
        if($user && Hash::check($request->passwd, $user->passwd)){
            Auth::login($user);
        
            if(Auth::check()){
                return view('logged.dashboard');
            }
            
            return redirect('login')->with('success', 'You are not allowed to access'); 
        }
        else
        {
            return redirect('login')->with('success', 'Login details are not valid.');
        }
    }

    public function dashboard(){
        if(Auth::check())
        {
            return view('start.dashboard');
        }

        return redirect('login')->with('success', 'You are not allowed to access'); 
    }

    public function logout(){

        Session::flush();
        Auth::logout();
        return redirect('login'); 
    }
}
