<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mail;
use Illuminate\Support\Str;

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
            'contact' =>['required' , 'numeric'],
            'address' =>['required'],
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
            $token = Str::random(60);
       
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'contact'=> $data['contact'],
                'address'=> $data['address'],
                'password' => Hash::make($data['password']),
                'role'=>'ROLE_EMPLOYEE',
                'position'=>'Employee',
                'status' => '0',
                'token' => $token    
            ]);
        
       //Mail send to the user for email varification
        $send = Mail::send('demo', ['data' => $data,'token'=>$token], function($message) use ($data) {
            $message -> to($data['email']) -> subject('Laravel Basic Testing Mail');
            $message -> from('jayesh.karavyasolutions@gmail.com','jayesh Gadani');
        });

        //Mail send to the Hr and Admin for Registration approval

        $emails = array("gadanijayesh@gmail.com", "parth.parmar12007@gmail.com"); 
        $send = Mail::send('email.registration_approve', ['data' => $data,'token'=>$token], function($message) use ($emails,$data) {
            $message -> to($emails)->subject('Approve new Registered user');
            $message -> from('jayesh.karavyasolutions@gmail.com','jayesh Gadani');
        });
        return $user;
    }
}
