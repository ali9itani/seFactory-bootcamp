<?php

namespace arts\Http\Controllers;

use Illuminate\Http\Request;

use arts\Http\Requests;
use Auth;
use Validator;
use File;
use arts\User;
use arts\Post;
use arts\Resource;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_user = $this->getCurrentUser();
        
        //get all user posts
        $posts = Post::where('publisher_id', '=', $current_user->id)
                       ->with('resources')->get();
                       
        return view('profile')->with(compact('posts'))
                              ->with(compact('current_user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation profile info inputs   
        $validator = Validator::make($request->all(), [
            'fullName' => 'max:50|alpha',
            'birthDate' => 'date',
            'bio' => 'max:200',
            'image' => 'mimes:jpeg,jpg,png|max:1000'
        ]);

        if ($validator->fails()) {
            return $validator->errors()->all();
        } else {
            $user = $this->getCurrentUser();
            $user->full_name = $request->fullName;
            $user->birth_date = $request->birthDate;
            $user->bio = $request->bio;
            
            $profile_photos_dir = '/public/img/profile-photo/';

            //check if there is animage to upload
            if($request->file('image') != null) {
                $request->file('image')->move(
                    base_path() . $profile_photos_dir,
                    $user->id.'.jpg'
                );
            }
            
            $user->save();
            return "s";
        }
    }

    // get info of current logged user
    private function getCurrentUser()
    {
        $user_id = Auth::user()->id;
        return User::find($user_id); 
    }

}
