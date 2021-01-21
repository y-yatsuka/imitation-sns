<?php
namespace App\Http\Controllers;

use App\Article;
use App\User;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller{

  public function __construct(){
    $this->middleware('auth')->except('show');
  }





  public function show($user_id){
    $user=User::find($user_id);
    $user_articles= Article::where('user_id',$user_id)->orderBy('id','desc')->get();
    $own= \Auth::user();

    //フォロー中のユーザーの数をカウント
    $follows=unserialize($user->follow);
    $follows_count=count($follows);

    //フォローされている数をカウント
    $followers=unserialize($user->follower);
    $followers_count=count($followers);

    $following=-1; //フォロー中か否かを格納する変数

    if($own){  //ログイン中であれば
      //ログイン中のユーザーでなけれはフォローしているかを判断
      if($user_id!=$own->id){
        $own_follows=unserialize($own->follow);
        if(isset($own_follows["$user_id"])){
          $following=1;
        }else{
          $following=0;
        }
      }
    }


    return view('user_show',['user' => $user, 'user_articles' => $user_articles,
                             'own' => $own, 'follows_count' => $follows_count,
                             'followers_count' => $followers_count, 'following' => $following]);
  }






  public function edit(){
    $own=\Auth::user();
    return view('user_edit', ['own' => $own]);
  }






  public function update(Request $request){
    $own= \Auth::user();
    $own->name=$request->input('name');
    $own->introduction=$request->input('introduction');
    $own->save();
    return redirect()->route('user.detail',['user_id'=> $own->id]);
  }



  public function followList($user_id){
    $user=User::find($user_id);
    $follows=unserialize($user->follow);
    //フォロー中のユーザー情報を取得
    $users=User::whereIn('id',$follows)->get();

    return view('follow_list',['users' => $users]);
  }



  public function followerList($user_id){
    $user=User::find($user_id);
    $followers=unserialize($user->follower);
    //フォロワーのユーザー情報を取得
    $users=User::whereIn('id', $followers)->get();

    return view('follower_list', ['users' => $users]);
    }
}
