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
        $users = User::displayAll();

        /**if ($users->onLastPage() < $request->get('page')) {
            echo "<pre>"; print_r('check'); exit;
            return redirect()->route('user');
           
        }
        echo "<pre>"; print_r($users->onLastPage().' '.$request->get('page')); exit;
         */
        return view("ViewUser", compact('users'));
    }

    /**
     * Add new user
     * @param Request $request 
     */
    public function add(Request $request)
    {
        $user = new User();

        if ( $request -> isMethod('POST') ) {
           
            $data = $request->all();

            $this->validation($request, $user->id);

            $password = Str::random(8);

            $email = '';
            if ( isset($data['email']) ) {
                $email = $data["email"];
            }

            $result = $user->addUser($data,$password);

            if ( $email ) {

                $send = Mail::send('email_password', ['data' => $data, 'password' => $password], function($message) use ($email, $data) {
                    $message->to($email)->subject('Find your temporary password');
                    $message->from(config('from_email'),config('from_name'));
                });

            }

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

        $result = User::deleteUser($data);
        if ($result == 1) {
            $request -> session() -> flash('success', 'User deleted successful!');
        } else {
            $request -> session() -> flash('error', 'Result not deleted!');
        }

        return Response::json(array('message' => 'User deleted sucessfully '));


    }
    
    /**
     * update user
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
          
            $this->validation($request, $user->id);
           
            $user = new User();
            $result = $user->editUser($data, $id);
            if($result) {
                $request -> session() -> flash('success', 'User updated Sucessfully!');
                return redirect() -> route('user');    
            }
        }
          
        return view("addUser", compact('user')); 
    }

    /**
     * [parmission is used to give user parmission]
     * @param  Request $request [request data]
     * @param  [number]  $id    [user id]
     * @return [string]         [response]
     */
    public function parmission(Request $request, $id)
    {

        $result = User::parmission($id);

        if($result)
            $message = "Parmission Approval!";
        else
             $message = "Parmission Dis Approval!";

        $request -> session() -> flash('success', $message);
        return redirect() -> route('user');

    }

    /**
     * [validation function is used to check validation]
     * @param  [object] $request [data passed by the user]
     * @param  [number] $id      [edit time uniqueness of  email address not reuired]
     * @return [boolean]         [true for sucess and false on failed]
     */
    public function validation($request, $id)    
    {
        
        $validated = $request->validate([
                'name' => 'required|max:255|min:3|regex:/^[\pL\s\-]+$/u',  
                'email' => 'required|email:rfc,dns|unique:users,email,'.$id,
                'contact' => 'required|numeric|digits:10',
                'address' => 'required',
                'role' => 'required',
                'position' => 'required',
            ], [
                'name.required' => 'Please enter your name.',
                'name.max' => 'Only 255 character allowed in name.',
                'name.min' => 'Minimum three character required in name.',
                'name.regex' => 'Number not allowed',
                'email.required' => 'Please enter your email.',
                'email.email' => 'Please enter valid email address.',
                'email.unique' => 'Email address is already exists.',
                'contact.required' => 'Please enter contact number.',
                'contact.digits' => 'Please enter 10 digits in contact.',
                'contact.numeric' => 'Character not allowed in number.',
                'address.required' => 'Please enter address.',
                'role.required' => 'Please select role.',
                'position.required' => 'Please select position',
            ]
        );

    }
}