<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Article;
use Illuminate\Http\Request;

class ReplyController extends Controller
{

    public function show($reply_id)
    {
      $reply=Reply::find($reply_id);
      $children=Reply::where('parent',$reply_id)->get();
      $own=\Auth::user();
      $goods=unserialize($reply->good);
      $goodCount=count($goods);


      //返信先がarticleかreplyか
      $flag=0;
      if($reply->article_id){
        $parent=Article::find($reply->article_id);
        $flag=1;
      }else{
        $parent=Reply::find($reply->parent);
      }


      $favorite=-1; //いいねしているか否か
      if($own){
        if(isset($goods["$own->id"])){
          $favorite=1;
        }else{
          $favorite=0;
        }
        $login_id=$own->id;
      }else{
        $login_id='';
      }

      return view('reply_show',['reply' => $reply, 'children' => $children, 'login_id' => $login_id,
                                 'goodCount' => $goodCount, 'favorite' => $favorite ,'parent' => $parent ,'flag' => $flag]);
    }


    public function create($reply_id)
    {
      return view('reply_new',['reply' => Reply::find($reply_id), 'message' => '']);
    }



    public function store(Request $request)
    {
      $own=\Auth::user();
      $reply= new Reply;
      $reply->content=$request->input('content');
      $reply->parent=$request->input('id');
      $reply->user_id=$own->id;
      $reply->good=serialize(array());
      $reply->save();

      return redirect()->route('reply.detail',['reply_id' => $reply->id]);
    }

    public function destroy($reply_id){
      $reply=Reply::find($reply_id);
      if($reply->article_id){
        $article_id=$reply->article_id;
        $reply->delete();
        return redirect()->route('article.detail',['id' => $article_id]);
      }else{
        $reply_id=$reply->parent;
        $reply->delete();
        return redirect()->route('reply.detail',['reply_id' => $reply_id]);
      }

    }
}
