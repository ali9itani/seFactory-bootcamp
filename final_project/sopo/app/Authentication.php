<?php

namespace SOPO;

use Illuminate\Database\Eloquent\Model;

class Authentication extends Model
{
    public $timestamps = false;

    /**
     * Get the user that owns the authentication.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
