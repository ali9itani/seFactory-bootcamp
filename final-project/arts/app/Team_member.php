<?php

namespace arts;

use Illuminate\Database\Eloquent\Model;

class Team_member extends Model
{
    /**
     * Get the user that owns the team_member.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    /**
     * Get the team that owns the team_member.
     */
    public function team()
    {
        return $this->belongsTo('App\Team');
    }
}
