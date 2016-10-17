<?php

namespace arts\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use arts\User;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', '=', $user_id)->first(); 

        return view('home')->with(compact('user'));
    }
}
