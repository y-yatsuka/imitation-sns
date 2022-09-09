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
    $user_articles= $user->articles()->where('parent_id', null)->orderBy('id', 'DESC')->get();
    $own= \Auth::user();

    //フォロー中のユーザーの数をカウント
    $follows_count = count($user->followees()->get());

    //フォローされている数をカウント
    $followers_count = count($user->followers()->get());

    $following = false; //フォロー中か否かを格納する変数

    if($own){  //ログイン中であれば
      //ログイン中のユーザーでなけれはフォローしているかを判断
      if($user_id != $own->id){
        foreach($own->followees()->get() as $followee){
            if($followee->id == $user_id){
                $following = true;
                break;
            }
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

    $validateData=$request->validate([
      'name' => 'required|max:255',
      'introduction' => 'max:255',
      'image' => 'mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $own->name=$request->input('name');
    $own->introduction=$request->input('introduction');
    if($request->image!=null){
      $request->image->storeAs('/public/profile_images', $own->id.'.jpeg');
      $own->image=$own->id.'.jpeg';
    }
    $own->save();
    return redirect()->route('user.detail',['user_id'=> $own->id]);
  }



  public function followList($user_id){
    $users = User::find($user_id)->followees()->get();

    return view('follow_list', ['users' => $users]);
  }



  public function followerList($user_id){
    $users = User::find($user_id)->followers()->get();

    return view('follower_list', ['users' => $users]);
    }
}
