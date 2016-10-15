<?php

namespace arts;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo('arts\User', 'publisher_id', 'id');
    }

    /**
     * Get the post_votes for the post.
     */
    public function post_votes()
    {
        return $this->hasMany('arts\Post_vote', 'post_id', 'post_id');
    }

     /**
     * Get the tags of this post
     */
    public function tags()
    {
        return $this->hasMany('arts\Tag', 'post_id', 'post_id');
    }

    //get down votes count
    public function downVotesCount()
    {
      return $this->post_votes()
        ->selectRaw('post_id, count(*) as count')
        ->where('vote', '=', '-1')
        ->groupBy('post_id');
    }

    //get up votes count
    public function upVotesCount()
    {
      return $this->post_votes()
        ->selectRaw('post_id, count(*) as count')
        ->where('vote', '=', '1')
        ->groupBy('post_id');
    }

    /**
     * Get the post_tags for the post.
     */
    public function post_hash_tags()
    {
        return $this->hasMany('arts\Post_hash_tag', 'post_id', 'post_id');
    }

    /**
     * Get the comments for the post.
     */
    public function post_comments()
    {
        return $this->hasMany('arts\Post_comment', 'post_id', 'post_id');
    }

    /**
     * Get the resources for the blog post.
     */
    public function resources()
    {
        return $this->hasMany('arts\Resource', 'post_id', 'post_id');
    }
}
