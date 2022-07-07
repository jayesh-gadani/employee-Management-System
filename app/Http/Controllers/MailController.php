<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
Use DateTime;
use Carbon\Carbon;

class MailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return view('home');
    }
    public function forgotPassword(Request $request)
    {
        

        $email = $request['email'];
        $data = $request->All();

        $validated = $request->validate([
                'email' => 'required|string|max:255',       
        ]);

       
        $user = User::where('email',$email)->first();
        if ($user) {
            $token = Str::random(60);
       
            $send = Mail::send('email.forgotPassword', ['data' => $data,'token'=>$token], function($message) use ($data) {
            $message -> to($data['email']) -> subject('Forgot Password');
            $message -> from('jayesh.karavyasolutions@gmail.com','jayesh Gadani');
            });
       
            $date =Carbon::now();
            $user->token = $token;
            $user->token_varified_at=$date;
            $user->save();
       
            $request -> session() -> flash('sucess', 'Link is shared on your email.Please check your email to forgot password!');
            return redirect() -> route('password.request');

        }   
        else {
            $request -> session() -> flash('error', 'Email id is not valid!');
            return redirect() -> route('password.request');
         } 
     
    }
    public function forgotPasswordLink(Request $request)
    {

        
        $token = $request['verifyToken'];

        $user = User::where('token',$request['verifyToken'])->first();
        
        if ($user) {
            $date = Carbon::now();
            $verifyExpireDate = Carbon::createFromFormat('Y-m-d H:i:s', $user->token_varified_at);
        
            $different = $date->diffInHours($verifyExpireDate);

            if ($different < 2) {
                 return view('resetPassword',['token'=>$token]);
            } else {
                $user->token = null;
                $user->save();
                $request -> session() -> flash('error', 'Forgot Password link is Expire!');
                return redirect() -> route('login');
            }    

        } else {
            
            $request -> session() -> flash('error', 'Forgot Password link is Expire!');
            return redirect() -> route('login');
        }
     }
            
        
    public function resetPassword(Request $request)
    {
        $data = $request->All();
        $validated = $request->validate([
            'password' => 'required|min:8|max:14',
            'confirmPassword' => 'required|min:8|max:14|same:password',
       
        ]);        
       
        $user = User::where('token',$request['token'])->first();
        $user->password = Hash::make($request['password']);
        $user->token = '';
        $user->save(); 
        $request -> session() -> flash('sucess', 'Password is changed sucessfully!');
        return redirect() -> route('login');
                
    }
        
}
