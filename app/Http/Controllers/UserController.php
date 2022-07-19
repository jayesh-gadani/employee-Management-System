<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use DateTime;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Str;
use Mail;
use Config;
use Response;

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
        $users = new User();
        $users= $users->displayAll();
     
        return view("ViewUser", compact('users'));   
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
                'name' => 'required|max:255|min:3',
                'email' => 'required|email|unique:users',
                'contact' => 'required|digits:10|numeric',
                'address' => 'required',
                'role' => 'required',
                'position' => 'required',
            ]);

           $user=new user();
           $password = Str::random(8);
           $emails = $data["email"];
           $result=$user->addUser($data,$password);
          
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
    public function delete(Request $request)
    {

        $data = $request -> all();
        $user = new User();
        $result = $user->deleteUser($data);
        if ($result == 1) {
            $request -> session() -> flash('success', 'User deleted successful!');
        } else {
            $request -> session() -> flash('error', 'Result not deleted!');
        }

        return Response::json(array('message' => 'User deleted sucessfully '));
        return redirect()->route('user');

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
        
        if (!$user) {
            throw new Exception("Error Processing Request", 401);
        }
        if ($request -> isMethod('POST')) {
            
            
            $data = $request -> all();
          
            $validated = $request ->validate([
                
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users',
                'contact' => 'required|numeric|digits:10',
                'address' => 'required',
                'role' => 'required',
                'position' => 'required',

            ]);
           
            $user = new User();
            $result = $user->editUser($data, $id);
            if($result) {
                $request -> session() -> flash('success', 'User updated Sucessfully!');
                return redirect() -> route('user');    
            }
           
            
        }
          
        return view("addUser", compact('user')); 
    }

    public function parmission(Request $request, $id)
    {
        $user = new User();
        $result = $user->parmission($id);         
        if($result)
            $message = "Parmission Approval!";
        else
             $message = "Parmission Dis Approval!";
        $request -> session() -> flash('success', $message);
        return redirect() -> route('user');

    }
}
