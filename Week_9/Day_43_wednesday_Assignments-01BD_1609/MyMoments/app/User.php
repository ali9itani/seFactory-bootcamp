<?php

namespace MyMoments;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     /**
     * Get the posts for the user.
     */
    public function posts()
    {
        return $this->hasMany('MyMoments\Post');
    }
     /**
     * Get the messages for the user.
     */
    public function messages()
    {
        return $this->hasMany('MyMoments\Message');
    }
     /**
     * Get the folowers for the user.
     */
    public function followers()
    {
        return $this->hasMany('MyMoments\Following');
    }
     /**
     * Get the likes for the user.
     */
    public function likes()
    {
        return $this->hasMany('MyMoments\Like');
    }

}
