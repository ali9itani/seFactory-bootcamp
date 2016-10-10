<?php

namespace arts;

use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    /**
     * Get the user that owns it.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
