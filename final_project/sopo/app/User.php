<?php

namespace SOPO;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
     /**
     * Get the authentications for the user.
     */
    public function authentications()
    {
        return $this->hasMany('App\Authentications');
    }
}
