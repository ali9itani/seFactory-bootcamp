<?php

namespace arts;

use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
     protected $fillable = [
        'followed_id', 'follower_id'
    ];

    // get the user that is followed by another
    public function user_followed()
    {
        return $this->belongsTo('arts\User', 'followed_id', 'id');
    }

    // get the user that follow the another
    public function user_following()
    {
        return $this->belongsTo('arts\User', 'follower_id', 'id');
    }
}
