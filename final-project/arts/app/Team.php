<?php

namespace arts;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
	/**
     * Get the art that owns the team.
     */
    public function art()
    {
        return $this->belongsTo('App\Art');
    }
    /**
     * Get the artist that owns the team.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
     /**
     * Get the team_members for the team.
     */
    public function team_members()
    {
        return $this->hasMany('App\Team_member');
    }
     /**
     * Get the posts for the team.
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
