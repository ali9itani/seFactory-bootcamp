<?php

namespace MyMoments;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    /**
     * Get the post that owns the comment.
     */
    public function post()
    {
        return $this->belongsTo('MyMoments\Post');
    }
}
