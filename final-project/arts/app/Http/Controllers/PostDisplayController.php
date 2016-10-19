<?php

namespace arts\Http\Controllers;

use Illuminate\Http\Request;

use arts\Http\Requests;
use arts\Post;
use arts\Post_vote;
use arts\User;

class PostDisplayController extends Controller
{

    public function display($post_id)
    {
        $post = Post::where('post_id', '=', $post_id)->with('user')->with('resources')
                ->with('upVotesCount')->with('downVotesCount')
                ->with('post_comments')->first();

        return view('display_post')->with(compact('post'));
    }

    /**
     * process a follow request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function like(Request $request)
    {
        if(User::where('username', '=', $request->userName)->exists()){

          $followed_id = User::where('username', '=', $request->userName)
                        ->first()->id;

          $follower_id = Auth::user()->id;

          // check if exist remove else add
          $following = Following::firstOrNew(array(
              'followed_id' => $followed_id, 'follower_id' => $follower_id));

          if ($following->exists) {

              $following->where([
                                ['followed_id', '=', $followed_id],
                                ['follower_id', '=', $follower_id],
                            ])->delete();
              return 0;

          } else {

              $following->followed_id = $followed_id;
              $following->follower_id = $follower_id;
              $following->save();
              return 1;
          }
       }
    }

    /**
     * process a follow request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function vote(Request $request)
    {
        if(User::where('username', '=', $request->userName)->exists()){

          $followed_id = User::where('username', '=', $request->userName)
                        ->first()->id;

          $follower_id = Auth::user()->id;

          // check if exist remove else add
          $following = Following::firstOrNew(array(
              'followed_id' => $followed_id, 'follower_id' => $follower_id));

          if ($following->exists) {

              $following->where([
                                ['followed_id', '=', $followed_id],
                                ['follower_id', '=', $follower_id],
                            ])->delete();
              return 0;

          } else {

              $following->followed_id = $followed_id;
              $following->follower_id = $follower_id;
              $following->save();
              return 1;
          }
       }
    }

     /**
     * process a follow request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function comment(Request $request)
    {
        if(User::where('username', '=', $request->userName)->exists()){

          $followed_id = User::where('username', '=', $request->userName)
                        ->first()->id;

          $follower_id = Auth::user()->id;

          // check if exist remove else add
          $following = Following::firstOrNew(array(
              'followed_id' => $followed_id, 'follower_id' => $follower_id));

          if ($following->exists) {

              $following->where([
                                ['followed_id', '=', $followed_id],
                                ['follower_id', '=', $follower_id],
                            ])->delete();
              return 0;

          } else {

              $following->followed_id = $followed_id;
              $following->follower_id = $follower_id;
              $following->save();
              return 1;
          }
       }
    }
}
