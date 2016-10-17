<?php

namespace arts;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Art extends Model
{
     /**
     * Get the artists_ids for the art.
     */
    public function artist_arts()
    {
        return $this->hasMany('arts\Artist_art','art_id' ,'art_id');
    }

    //check if current user has a relation to this art
    public function loggedArtistHasArt()
    {
        $user_id = Auth::user()->id;
 
        foreach ($this->artist_arts as $art_artist) {
            if($user_id == $art_artist->artist_id) {
                return true;
            } else {
                return false;
            }
        }

    }
}
