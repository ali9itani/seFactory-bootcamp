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
     * Display a profile
     *
     * @return \Illuminate\Http\Response
     */
    public function displayMyProfile()
    {
        $artist = $this->getCurrentUser()->with('following')
                       ->with('followers')->get();

        //get all user posts
        $posts = Post::where('publisher_id', '=', $artist[0]->id)
                       ->with('upVotesCount')->with('downVotesCount')
                       ->with('post_comments')->with('resources')->get();
                       
        return view('profile')->with(compact('posts'))
                              ->with(compact('artist'));
    }


    /**
     * Display a profile of another artist
     *
     * @return \Illuminate\Http\Response
     */
    public function artistProfile($username)
    {
        if(User::where('username', '=', $username)->exists()){
            //if the authenticated user requested a profile that has his username
            if(!Auth::guest()){
              $current_user = $this->getCurrentUser()->get();

              if($current_user[0]->username == $username){
                $this->displayMyProfile();
              }
            } 

            $artist = User::where('username', '=', $username)
                      ->with('following')->with('followers')->get();

            //get all user posts
            $posts = Post::where('publisher_id', '=', $artist[0]->id)
                           ->with('upVotesCount')->with('downVotesCount')
                           ->with('post_comments')->with('resources')->get();
                           
            return view('profile')->with(compact('posts'))
                                  ->with(compact('artist'));
        } else {
          return 'user doesnt exist';
        }
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
        return User::where('id', '=', $user_id); 
    }

}
