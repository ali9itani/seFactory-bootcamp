<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;

use Blog\Http\Requests;
use Blog\User;
use Blog\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_posts = Post::orderBy('id', 'DESC')->paginate(3);

        $posts = [];
        $data = [];

        foreach ($all_posts as $post) {
            $post_author_name = User::find($post->author_id)->name;

            //to just pick first 200 chars for post text
            if(strlen($post->text)> 300){
                $post->text = substr($post->text,0,300)."...";
            }

            $post->author_name = $post_author_name;
        }
        
        return view('posts')->with('posts',$all_posts);
    }
}
