<?php

namespace MyMoments\Http\Controllers;

use Illuminate\Http\Request;

use MyMoments\Http\Requests;
use MyMoments\Post;
class UploadImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('upload_image');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // //validate
        $this->validate($request, array(
                'hashtags' => 'max:300',
                'image-caption' => 'required|max:2200'
            ));

        //saved to db
        $post = new Post;

        $post->hashtags = $request->hashtags;
        $post->image_caption = $request->imagecaption;
        $post->created_at = date("Y-m-d h:i:s");
        $post->post_image_link = "xx";
        $post->post_user_id = Auth::user()->id;

        $post->save();

        echo "ok";
        //redirect to post details page using route name
        //return $this->show($post->id);
    }
}
