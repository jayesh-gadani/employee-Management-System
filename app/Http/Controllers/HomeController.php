<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use DateTime;
use App\Models\User;

class HomeController extends Controller
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
    public function index()
    {
        return view('home');
    }
    public function email_veryfy()
    {
        $token=$_GET["verifyToken"];
        $d=new DateTime();

// update query
   
        $q = User::where('token', $token)->first();
        $q->token='';
        $q->email_verified_at=$d;
        $q->save();

        return redirect()->route('login');
       // return view('__/login');

    }
}
