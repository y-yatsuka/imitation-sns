<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'id','name', 'email', 'password','introduction',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles(){
        return $this->hasMany('App\Article');
    }

    public function followers(){
        return $this->belongsToMany('App\User', 'follow', 'followee_id', 'follower_id')->withTimestamps();
    }

    public function followees(){
        return $this->belongsToMany('App\User', 'follow', 'follower_id', 'followee_id')->withTimestamps();
    }

    public function favoriteArticles(){
        return $this->belongsToMany('App\Article', 'favorite', 'user_id', 'article_id')->withTimestamps();
    }
}
