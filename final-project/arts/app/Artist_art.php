<?php

namespace arts;

use Illuminate\Database\Eloquent\Model;

class Artist_art extends Model
{
    /**
     * Get the user that owns it
     */
    public function user()
    {
        return $this->belongsTo('arts\User');
    }
    /**
     * Get the art that owns it
     */
    public function art()
    {
        return $this->belongsTo('arts\Art', 'art_id', 'art_id');
    }
}
