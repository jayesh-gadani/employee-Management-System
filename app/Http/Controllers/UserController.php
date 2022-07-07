<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use DateTime;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;
use Config;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        
        $data1 = User::All(); 
        
        return view("ViewUser",compact('data1'));
        
    }

    /**
     * new user registration
     * @param Request $request 
     */
    public function add(Request $request)
    {
        $user = new User();

        if ($request -> isMethod('POST')) {
           
            $data = $request->all();
          
            $validated = $request->validate([
                'name' => 'required|alpha|max:255',
                'email' => 'required',
                'contact' => 'required|digits:10',
                'address' => 'required',
            ]);


            $id = Auth::user()->id;
            $password = Str::random(8);
            $emails = $data["email"];

            $user = new User();
            $user->name = $data["name"];
            $user->email = $data["email"];
            $user->contact = $data["contact"];
            $user->address = $data["address"]; 
            $user->password = Hash::make($password);
            $user->role = $data["role"];
            $user->position = $data["position"];

            $user->status = 1;
            $user->created_by = $id;
            $user->updated_by = $id;
            $user->save();
           // $emails = array("gadanijayesh@gmail.com", "parth.parmar12007@gmail.com");  

            $send = Mail::send('email_password', ['data' => $data, 'password' => $password], function($message) use ($emails, $data) {
                $message->to($emails)->subject('Find our your temporary password');
                $message->from('jayesh.karavyasolutions@gmail.com','jayesh Gadani');
            });

           $request->session()->flash('success', 'User Added Sucessfully!');

           return redirect()->route('user');

       }

        return view("addUser", compact('user'));
    }

    /**
     * delete user
     * @param  Request $request [description]
     * @param  [number]  $id      [description]
     * @return [void]           [description]
     */
    public function delete(Request $request, $id)
    {
        $user = User::find($id);

        if ($user->delete()) {
            $request -> session() -> flash('success', 'User deleted successful!');
        } else {
            $request -> session() -> flash('error', 'Result not deleted!');
        }

        return redirect() -> route('user');
    }
    
    /**
     * edit user
     * @param  Request $request [description]
     * @param  [number]  $id      [description]
     * @return [void]           [description]
     */
    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        if ($request -> isMethod('POST')) {
            
            
            $data = $request -> all();
          
            $validated = $request ->validate([
                
                'name' => 'required|alpha|max:255',
                'email' => 'required',
                'contact' => 'required|digits:10',
                'address' => 'required',

            ]);
           
            $user->name = $data["name"];
            $user->email = $data["email"];
            $user->contact = $data["contact"];
            $user->address = $data["address"]; 
            $user->role = $data["role"];
            $user->position = $data["position"];
          
            $user->save();
            $request -> session() -> flash('success', 'User updated Sucessfully!');
            return redirect() -> route('user');
        }
          
        return view("addUser", compact('user')); 
    }

    public function parmittion(Request $request, $id)
    {
        $user = User::find($id);
        $status = $user['status'];
        $message = "";
        if ($status == 0) {
            $user->status = '1';
            $message="Parmission Approval!";
        } else {
            $user->status = '0';
            $message="Parmission Dis Approval!";
        }   
        
        $user->save();         
        
        $request -> session() -> flash('success', $message);
        return redirect() -> route('user');

    }
}
