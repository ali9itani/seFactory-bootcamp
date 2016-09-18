<?php

namespace MyMoments\Http\Controllers;

use Illuminate\Http\Request;

use Datetime;
use MyMoments\Http\Requests;
use Auth;
use MyMoments\Post;
use MyMoments\User;
use MyMoments\Like;
use MyMoments\PostComment;

class PostsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all posts details
        $posts = Post::orderBy('post_id', 'DESC')->get();

        foreach ($posts as $post) {
          $post_author_name = User::find($post->post_user_id)->username;
          $likes_count = Like::where('post_id', $post->post_id)->count();
          $post_comments = PostComment::where('post_id', '=', $post->post_id)->get();

          $post->post_author_name = $post_author_name;
          $post->likes_count = $likes_count;

          //check if this post is liked by current user
          $current_user_id  = Auth::user()->id;
          $matchThese = ['liker_id' => $current_user_id, 'post_id' => $post->post_id];
          $is_liked = Like::where($matchThese)->get();
         
          if(count($is_liked))
          {
            $post->is_liked = true;
          } else {
            $post->is_liked = false;
          }

          //getting time passed since posted
          $created_date = new DateTime($post->created_at);
          $now_date = new Datetime();
          $date_time_difference = $created_date->diff($now_date);
          $post->time = $date_time_difference->format('%ad %hhr %imin');

          $all_comments = [];

          //get comments and the usernames
          foreach ($post_comments as $post_comment) {
            $comment_username = User::find($post_comment->user_id)->username;

            if($comment_username == Auth::user()->username)
            {
              $comment_username = "you";
            }
            array_push($all_comments , $comment_username." : ".$post_comment->comment_text); 
          }
          $post->comments = $all_comments;
        }
      
        return view('posts', compact('posts'));
    }

    // recives a post request to like a post
    public function like(Request $request)
    {
      $post_id = $request['post_id'];
      $current_user_id  = Auth::user()->id;

      //check if this post is liked by current user
      $matchThese = ['liker_id' => $current_user_id, 'post_id' => $post_id];
      $is_liked = Like::where($matchThese)->get();
     
      if(count($is_liked))
      {
        //delete the like record
        Like::where($matchThese)->delete();

      } else {
        //insert new like
        $like = new Like;
        $like->post_id = $post_id;
        $like->liker_id = $current_user_id;

        $like->save();
      }
      
    }

    // recives a post request to comment on a post
    public function comment(Request $request)
    {
      $post_id = $request['post_id'];
      $current_user_id  = Auth::user()->id;

      $post_comment = new PostComment;
      $post_comment->post_id = $post_id;
      $post_comment->user_id = $current_user_id;
      $post_comment->comment_text = $request['comment_text'];

      $post_comment->save();
    }
}
