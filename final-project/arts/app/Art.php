<?php

namespace arts;

use Illuminate\Database\Eloquent\Model;

class Art extends Model
{
     /**
     * Get the artists_ids for the art.
     */
    public function artist_arts()
    {
        return $this->hasMany('App\Artist_art');
    }
    /**
     * Get the teams for the art.
     */
    public function teams()
    {
        return $this->hasMany('App\Team');
    }
}
