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
use arts\Art;
use arts\Artist_art;

class EditProfileController extends Controller
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
                       ->with('upVotesCount')->with('downVotesCount')
                       ->with('post_comments')
                       ->with('resources')->get();

        //get list of available arts
        $arts = Art::get();
                       
        return view('edit-profile')->with(compact('posts'))
                ->with(compact('current_user'))->with(compact('arts'));
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
            'fullName' => 'required|max:50',
            'birthDate' => 'required|date',
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
            $user->website = $request->website;
            
            $arts_array = explode(',', $request->select);

            //delete all his old arts 
            Artist_Art::where('artist_id', Auth::user()->id)->delete();

            if($arts_array[0]){
                //save his selected arts
                foreach ($arts_array as $value) {
                     $artist_art = new Artist_art();
                     
                     $artist_art->insert(['art_id' => $value,
                                 'artist_id' => Auth::user()->id]);
                }
            }
            
            $profile_photos_dir = '/public/img/profile-photo/';

            //check if there is animage to upload
            if($request->file('image') != null) {
                $request->file('image')->move(
                    base_path() . $profile_photos_dir,
                    $user->id.'.jpg'
                );
            }
            
            $user->save();
            return ["success"];
        }
    }

    // get info of current logged user
    private function getCurrentUser()
    {
        $user_id = Auth::user()->id;
        return User::find($user_id); 
    }
}
