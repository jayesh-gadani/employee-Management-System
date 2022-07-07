<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use DateTime;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Validator;

class ChangePasswordController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $id = Auth::user()->id;
        $user = Auth::user();

        if ($request->isMethod('POST')) {
           
            $data = $request->all();

            /*$validated = $request->validate([
                'password'=>'required|min:8|max:14',
                'match_password'=>[Rule::when(!Hash::check($data['password'], $user['password']),['required'])],
                'newPassword' => 'required|min:8|max:14',
                'confirmPassword' => 'required|min:8|max:14|same:newPassword',
            ]);*/

            $rules = [
                'password'=>'required|min:8|max:14',
                'match_password'=>[Rule::when(!Hash::check($data['password'], $user['password']),['required'])],
                'newPassword' => 'required|min:8|max:14',
                'confirmPassword' => 'required|min:8|max:14|same:newPassword',
            ];

            //$validator = Validator::make($data, $rules);

            $validated = $request->validate($rules);

            // if ($validator->fails()) {
                
            // }

            if (Hash::check($data['password'], $user['password'])) {

                $user->password = Hash::make($data['newPassword']);
                $user->save();

                $request->session()->flash('success', 'Password sucessfuuly Changeed!');
            } else {
                $request->session()->flash('error', 'Old password does not matched.');
            }
        }
        return view('ChangePassword');
    }
    
}
