<?php

namespace arts;

use Illuminate\Database\Eloquent\Model;

class Post_hash_tag extends Model
{
    /**
     * Get the hash_tags that owns the post_tag.
     */
    public function hash_tag()
    {
        return $this->belongsTo('arts\Hash_tag');
    }
    /**
     * Get the post that owns the post_tag.
     */
    public function post()
    {
        return $this->belongsTo('arts\Post');
    }
}
