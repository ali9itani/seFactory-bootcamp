<?php

namespace MyMoments\Http\Controllers;

use Illuminate\Http\Request;

use MyMoments\Http\Requests;
use Auth;
use MyMoments\User;
use MyMoments\Post;
use MyMoments\Following;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_user = Auth::user();
        $followers_count = Following::where('followed_id', $current_user->id)->count();
        $following_count = Following::where('follower_id', $current_user->id)->count();
        $posts = Post::where('post_user_id','=', $current_user->id)->get();

        $data['username'] =  $current_user->username;
        $data['name'] = $current_user->name;
        $data['followers_count'] = $followers_count;
        $data['following_count'] = $following_count;
        $data['posts_count'] = $posts->count();
        $data['profile_link'] =  $current_user->image_link;
        $data['posts'] =  $posts;
        
       return view('display_profile')->with('data',$data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

}
