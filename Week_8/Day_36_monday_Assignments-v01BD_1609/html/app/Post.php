<?php

namespace Blog;

use Illuminate\Database\Eloquent\Model;

class Post extends Model 
{
    protected $fillable = ['id','title','author_id','text','created_at'];

    public $timestamps = false;

 	public function user() {
 		return $this->belongsTo('Blog\User');
 	}
}
