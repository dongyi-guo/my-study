<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

//sachin(668690)
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    //sachin(668690)
    public function registration(){
            return view('start.home-register');
    }

    public function validate_registration(Request $request){

        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'    => ['required', 'string', 'min:8', 'confirmed'],
            'address'     => ['required', 'string', 'max:255'],
        ]);
        
        
        $data = $request->all();
        
        // Assigning zone value to the variable.
        $zone_value = 0;
        if ($data['zone'] == 'Zone A'){
            $zone_value=1;
        }
        elseif ($data['zone'] == 'Zone B'){
            $zone_value=2;
        }
        elseif ($data['zone'] == 'Zone C'){
            $zone_value=3;
        }
        elseif ($data['zone'] == 'Zone D'){
            $zone_value=4;
        }
        elseif ($data['zone'] == 'Zone E'){
            $zone_value=5;
        }
        
        //Trading position value
        $trading_position = 4;
        if(isset($request['buyer-check']))
        {
            if(isset($request['seller-check']))
            {
                $trading_position = 3;
            }
            else
            {
                $trading_position = 1;
            }
        }
        elseif(isset($request['seller-check']))
        {
            $trading_position = 2;
        }
        
        $ismanager = 0;
        $isactive = 1;
        $balance = 0;
        $postal_address = $data['address'];

        User::create([
            'tradingPositionId' => $trading_position,
            'userName' => $data['name'],
            'email' => $data['email'],
            'isManager' => $ismanager, 
            'passwd' => Hash::make($data['password']),
            'isActive' => $isactive,
            'postalAddress' => $postal_address,
            'zoneId' => $zone_value,
            'balance' => $balance,
        ]);

        return redirect('login')->with('success', 'Registration completed, now you can login.');
    }
}
