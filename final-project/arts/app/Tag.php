<?php

namespace arts;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $fillable = ['tag_title'];
    protected $table = 'tags';
    
 	/**
     * Get the post_ids for the Tag.
     */
    public function post_tags()
    {
        return $this->hasMany('App\Post_tag');
    }
}
