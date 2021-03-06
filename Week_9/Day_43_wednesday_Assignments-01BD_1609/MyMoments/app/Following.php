<?php

namespace MyMoments;

use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
     /**
     * Get the user that owns the message.
     */
    public function user()
    {
        return $this->belongsTo('MyMoments\User');
    }
}
