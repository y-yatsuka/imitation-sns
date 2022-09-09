<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;
use App\User;
use App\Reply;

class ContactController extends Controller
{
    public function followFunction(Request $request){
        $user_id=$request->input('user_id');
        $own=\Auth::user();
        $user=User::find($user_id);

        $following = false;
        foreach ($user->followers()->get() as $follower){
            if($follower->id == $own->id) {
                $following = true;
                break;
            }
        }
        if($following){
            $user->followers()->detach($own->id);
        }else{
            $user->followers()->attach($own->id);
        }

        return response()->json([
            'result' => true
        ]);

    }


    public function goodFunction(Request $request){
        $article_id=$request->input('article_id');
        $own=\Auth::user();
        $article=Article::find($article_id);

        $favorite = false;
        foreach ($article->usersLiked()->get() as $user){
            if($user->id == $own->id){
                $favorite = true;
                break;
            }
        }

        if($favorite){
            //いいねしていたらいいねを取り消す
            $article->usersLiked()->detach($own->id);
        }else{
            //いいねしていなかったらいいねする
            $article->usersLiked()->attach($own->id);
        }

        $goodCount=count($article->usersLiked()->get());

        return response()->json([
            'result' => $goodCount
        ]);
    }


    public function goodCount(Request $request){
        $article_id=$request->input('article_id');
        $article=Article::find($article_id);

        $goodCount = count($article->usersLiked()->get());
        return response()->json([
            'result' => $goodCount
        ]);
    }
}
