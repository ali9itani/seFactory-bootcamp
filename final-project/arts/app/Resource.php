<?php

namespace arts;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    /**
     * Get the post that owns the resource.
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
