<?php

namespace arts;

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
        'username', 'full_name', 'birth_date', 'email', 'password', 'bio'
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
     * Get the followings for the user.
     */
    public function followings()
    {
        return $this->hasMany('App\Following');
    }
    /**
     * Get the arts for the user.
     */
    public function artist_arts()
    {
        return $this->hasMany('App\Artist_art');
    }

    /**
     * Get the tags of this user
     */
    public function tags()
    {
        return $this->hasMany('arts\Tag', 'id', 'artist_id');
    }

    /**
     * Get the post votes for the user.
     */
    public function post_votes()
    {
        return $this->hasMany('App\Post_vote');
    }
    /**
     * Get the posts for the user.
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    /**
     * Get the team_members for the blog user.
     */
    public function team_members()
    {
        return $this->hasMany('App\Team_member');
    }
    /**
     * Get the followings for the blog post.
     */
    public function teams()
    {
        return $this->hasMany('App\Team');
    }

    // retrieve photo of user
    public function photo()
    {
        if(file_exists( public_path() . '/img/profile-photo/' . $this->id . '.jpg')) {
            return '/arts/public/img/profile-photo/' . $this->id .'.jpg';
        } else {
            return '/arts/public/img/profile-photo/default.jpg';
        }      
    }
}
