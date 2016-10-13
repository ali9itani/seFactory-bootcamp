<?php

namespace arts\Http\Controllers;

use Illuminate\Http\Request;

use arts\Http\Requests;
use Auth;
use Response;
use uniqid;
use Validator;
use arts\Post;
use arts\Resource;
use arts\Tag;
use arts\Post_tag;

class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            
        );

        // validation profile info inputs   
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Response::make($validator->errors(), 400);
        } else {

            //create new post and save it
            $post = new Post();
            $post->title = $request->title;
            $post->text = $request->text;
            $post->location = $request->location;
            $post->publisher_id = Auth::user()->id;
            $post->save();

            //save hashtags
            $hash_tags = explode(" ",$request->hashtags);
            foreach ($hash_tags as $value) {
                $tag = Tag::firstOrNew([
                    'tag_title' => $value,
                ]);

                if (!$tag->exists) { 
                    $tag->save();

                    //relation between post and its hashtag
                    $post_tag = new Post_Tag();
                    $post_tag->tag_id =  $tag->id;
                    $post_tag->post_id = $post->id;
                    $post_tag->save();
                }
            }

            //save images 
            $posts_photos_dir = '/public/img/posts-images/';
            $files = $request->file('file');

            if(!empty($files)){
                foreach($files as $file) { 

                    $image_name = uniqid(). '.' .
                                  $file->getClientOriginalExtension();

                    $file->move(
                        base_path() . $posts_photos_dir , $image_name
                    );

                    //create new resource
                    $resource =  new Resource();
                    $resource->post_id = $post->id;
                    $resource->resource_name =  $image_name;
                    $resource->save();
                }
            }   
    
            // $user->save();
            return "s";
        }
        // print_r($request->all());
    }

    public function rules($request)
    {
        $rules = [
            'name'          => 'max:500',
     ];

    $nbr = count($request->file) - 1;
    foreach(range(0, $nbr) as $index) {
        $rules['file.' . $index] = 'required|mimes:jpeg|max:10000';
    }

        return $rules;
    }
}
