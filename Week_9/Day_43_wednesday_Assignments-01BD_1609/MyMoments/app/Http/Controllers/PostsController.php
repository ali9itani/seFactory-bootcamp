<?php

namespace MyMoments\Http\Controllers;

use Illuminate\Http\Request;

use MyMoments\Http\Requests;
use MyMoments\Post;

class PostsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('post_id', 'DESC')->get();
        return view('posts', compact('posts'));
    }

}
