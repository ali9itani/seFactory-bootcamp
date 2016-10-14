<?php

namespace arts;

use Illuminate\Database\Eloquent\Model;

class Hash_tags extends Model
{
	protected $fillable = ['tag_title'];
    protected $table = 'hash_tags';
    
 	/**
     * Get the post_ids for the Tag.
     */
    public function post_hash_tags()
    {
        return $this->hasMany('App\Post_hash_tags');
    }
}
