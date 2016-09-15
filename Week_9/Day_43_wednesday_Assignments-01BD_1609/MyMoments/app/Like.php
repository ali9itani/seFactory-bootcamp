<?php

namespace MyMoments;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
     /**
     * Get the post that owns the like.
     */
    public function post()
    {
        return $this->belongsTo('MyMoments\Post');
    }
}
