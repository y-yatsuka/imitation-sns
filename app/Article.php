<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function usersLiked(){
        return $this->belongsToMany('App\User', 'favorite', 'article_id', 'user_id')->withTimestamps();
    }
}
