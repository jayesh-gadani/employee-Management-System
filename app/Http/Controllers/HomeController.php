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
        $token = $_GET["verifyToken"];
        $date = new DateTime();

        // update query
   
        $user = User::where('token', $token)->first();
        $user->token = '';
        $user->email_verified_at=$date;
        $user->save();

        return redirect()->route('login');
       

    }
}
