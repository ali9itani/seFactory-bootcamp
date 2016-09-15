<?php

namespace MyMoments;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Get the user that owns the message.
     */
    public function user()
    {
        return $this->belongsTo('MyMoments\User');
    }
     /**
     * Get the comments for the post.
     */
    public function comments()
    {
        return $this->hasMany('MyMoments\Comment');
    }
     /**
     * Get the likes for the post.
     */
    public function likes()
    {
        return $this->hasMany('MyMoments\LIke');
    }
}
