<?php

namespace arts;

use Illuminate\Database\Eloquent\Model;

class Post_comment extends Model
{
    /**
     * Get the user that owns the post_vote.
     */
    public function user()
    {
        return $this->belongsTo('arts\User', 'artist_id', 'id');
    }
    /**
     * Get the post that owns the post_vote.
     */
    public function post()
    {
        return $this->belongsTo('arts\Post');
    }
}
