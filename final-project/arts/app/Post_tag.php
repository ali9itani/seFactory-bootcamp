<?php

namespace arts;

use Illuminate\Database\Eloquent\Model;

class Post_tag extends Model
{
    /**
     * Get the tag that owns the post_tag.
     */
    public function tag()
    {
        return $this->belongsTo('App\Tag');
    }
    /**
     * Get the post that owns the post_tag.
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
