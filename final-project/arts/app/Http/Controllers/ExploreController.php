<?php

namespace arts\Http\Controllers;

use Illuminate\Http\Request;

use arts\Http\Requests;
use arts\Post;
use arts\Post_vote;
use arts\User;

class ExploreController extends Controller
{
    private $pagination_num = 2;
    /**
     * Display a listing of the posts by a random selection.
     */
    public function random()
    {
        $posts = Post::inRandomOrder()->with('user')->with('resources')
                ->with('upVotesCount')->with('downVotesCount')->paginate($this->pagination_num);

        return view('explore')->with(compact('posts'));
    }

    /**
     * Display a listing of the posts acc to most rated.
     */
    public function mostRated()
    {
        return view('explore');
    }

    /**
     * Display a listing of the trending posts.
     */
    public function trending()
    {
        return view('explore');
    }

    /**
     * Display a listing of the posts acc to most view.
     */
    public function mostViewed()
    {
        $posts = Post::orderBy('view_count', 'desc')->paginate($this->pagination_num);
        
        return view('explore')->with(compact('posts'));
    }

}
