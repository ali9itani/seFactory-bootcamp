<?php

namespace arts\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use arts\User;
use arts\Post;

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
        $user = $this->getCurrentUser()->first();

        $posts = [];
        foreach ($user->following as $follows) {

            $post = Post::where('publisher_id', '=', $follows->followed_id)->get();
            array_push($posts, $post);  
        }

        return view('home')->with(compact('user'))->with(compact('posts'));
    }

    // get info of current logged user
    private function getCurrentUser()
    {
        $user_id = Auth::user()->id;
        return User::where('id', '=', $user_id); 
    }
}
