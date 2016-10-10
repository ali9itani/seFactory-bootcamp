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
        return $this->belongsTo('App\User');
    }
    /**
     * Get the team that owns the post.
     */
    public function team()
    {
        return $this->belongsTo('App\Team');
    }
    /**
     * Get the post_votes for the post.
     */
    public function post_votes()
    {
        return $this->hasMany('App\Post_vote');
    }
    /**
     * Get the post_tags for the post.
     */
    public function post_tags()
    {
        return $this->hasMany('App\Post_tag');
    }
    /**
     * Get the resources for the blog post.
     */
    public function resources()
    {
        return $this->hasMany('App\Resource');
    }
}
