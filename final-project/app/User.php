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
     * Get who the user is following
     */
    public function following()
    {
        return $this->hasMany('arts\Following', 'follower_id', 'id');
    }

    /**
     * Get the user followers
     */
    public function followers()
    {
        return $this->hasMany('arts\Following', 'followed_id', 'id');
    }

    /**
     * Get the arts for the user.
     */
    public function artist_arts()
    {
        return $this->hasMany('arts\Artist_art', 'artist_id', 'id');
    }

    /**
     * Get the tags of this user
     */
    public function tags()
    {
        return $this->hasMany('arts\Tag', 'id', 'artist_id');
    }

    /**
     * Get the comments of this user
     */
    public function comments()
    {
        return $this->hasMany('arts\Post_comments', 'id', 'artist_id');
    }

    /**
     * Get the post votes for the user.
     */
    public function post_votes()
    {
        return $this->hasMany('arts\Post_vote');
    }

    /**
     * Get the posts for the user.
     */
    public function posts()
    {
        return $this->hasMany('arts\Post', 'publisher_id', 'id');
    }

    /**
     * Get the limit count of posts for the user.
     */
    public function limitedPostsToFive()
    {
        return $this->hasMany('arts\Post', 'publisher_id', 'id')->limit(5);;
    }

    /**
     * Get the team_members for the blog user.
     */
    public function team_members()
    {
        return $this->hasMany('arts\Team_member');
    }
    /**
     * Get the followings for the blog post.
     */
    public function teams()
    {
        return $this->hasMany('arts\Team');
    }

    // retrieve photo of user
    public function photo()
    {
        if(file_exists( public_path() . '/img/profile-photo/' . $this->id . '.jpg')) {
            return '/public/img/profile-photo/' . $this->id .'.jpg';
        } else {
            return '/public/img/default.gif';
        }      
    }
}
