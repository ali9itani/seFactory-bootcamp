<?php

namespace arts;

use Illuminate\Database\Eloquent\Model;

class Post_vote extends Model
{
    /**
     * Get the user that owns the post_vote.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    /**
     * Get the post that owns the post_vote.
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
