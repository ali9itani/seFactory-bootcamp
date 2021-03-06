<?php

namespace arts\Http\Controllers;

use Illuminate\Http\Request;

use arts\Http\Requests;
use arts\Post;
use arts\Post_vote;
use arts\User;

class ExploreController extends Controller
{
    private $pagination_num = 30;
    /**
     * Display a listing of the posts by a random selection.
     */
    public function random()
    {
        $posts = Post::inRandomOrder()->with('user')->with('resources')
                ->with('upVotesCount')->with('downVotesCount')
                ->with('post_comments')->paginate($this->pagination_num);

        return view('explore')->with(compact('posts'));
    }

    /**
     * Display a listing of the trending posts.
     */
    public function byartists()
    {
        $users = User::inRandomOrder()->limit(10)->get();

        return view('explore')->with(compact('users'));
    }

    /**
     * Display a listing of the posts acc to most view.
     */
    public function byViews()
    {
        $posts = Post::orderBy('view_count', 'desc')->with('user')->with('resources')
                ->with('upVotesCount')->with('downVotesCount')->paginate($this->pagination_num);
        
        return view('explore')->with(compact('posts'));
    }

}
