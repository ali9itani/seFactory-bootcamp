<?php

namespace arts;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * Get the user in this tag.
     */
    public function user()
    {
        return $this->belongsTo('arts\User', 'artist_id', 'id');
    }

    /**
     * Get the post of this tag.
     */
    public function post()
    {
        return $this->belongsTo('arts\Post', 'post_id', 'post_id');
    }

}
