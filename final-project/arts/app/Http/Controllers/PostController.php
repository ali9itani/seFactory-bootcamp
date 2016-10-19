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
use arts\Hash_tag;
use arts\Post_hash_tag;

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
        dd(['a'=>'a']);
        
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
            // $post->text = $request->text;
            // $post->location = $request->location;
            $post->publisher_id = Auth::user()->id;
            $post->save();

            //save hashtags
            $hash_tags = explode(" ",$request->hashtags);

            foreach ($hash_tags as $value) {
                $hash_tag = Hash_tag::firstOrNew(['tag_title' => $value,]);

                $hash_tag->save();

                //since the tag_title may exist so get its id
                $tag_id = 0;

                if ($hash_tag->tag_id){
                    $tag_id = $hash_tag->tag_id;
                } else {
                    $tag_id = $hash_tag->id;
                }

                //relation between post and its hashtag
                $post_hash_tag = new Post_hash_tag();
                $post_hash_tag->post_id = $post->id;
                $post_hash_tag->tag_id = $tag_id;
                $post_hash_tag->save();

            }

            //save tags
            $tags = explode(",",$request->tags);

            foreach ($tags as $value) {
                $tag = new Tag();
                $tag->insert(['post_id' => $post->id, 'artist_id'=> $value]);
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
