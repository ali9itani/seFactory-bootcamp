<?php

namespace MyMoments\Http\Controllers;

use Illuminate\Http\Request;

use MyMoments\Http\Requests;
use MyMoments\Post;
use Auth;

class UploadImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('upload_image')->with('uploaded');;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //validate inputs
        $this->validate($request, array(
                'hashtags' => 'max:300',
                'imagecaption' => 'required|max:2200',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ));

        //saved to db
        $post = new Post;

        $post->hashtags = $request->hashtags;
        $post->image_caption = $request->imagecaption;
        $post->created_at = date("Y-m-d h:i:s");
        
        $user_id = Auth::user()->id;
        $post->post_user_id = $user_id;

        $imageName = $user_id.time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName);

        $post->post_image_link = $imageName;

        $post->save();


        //refresh with success status
        return view('upload_image')->with('uploaded', 'Uploaded Successfully');
    }
}
