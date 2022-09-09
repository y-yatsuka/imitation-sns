<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use App\Reply;
use Illuminate\Http\Request;


class ArticleController extends Controller
{

    public function __construct(){
    $this->middleware('auth')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $own=\Auth::user();
        $name='ゲスト';

        if($own){
          //ログイン中ならばフォロー中のアカウントと自分の投稿のみを取り出す
          $name=$own->name;
          $displayUsers = [$own->id];
          foreach($own->followees()->get() as $followee){
              $displayUsers[] = $followee->id;
          }
          $articles=Article::whereIn('user_id',$displayUsers)->where('parent_id', null)->orderBy('id','desc')->get();
        }else{
          $articles=Article::orderBy('id','desc')->get();
        }

        return view('index',['articles' => $articles,'name' => $name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user= \Auth::user();

        $validateData=$request->validate([
          'content' => 'required|max:255',
          'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $article= new Article;
        $article->content= $request->input('content');
        $article->user_id=$user->id;
        if($request->hasFile('image')){
          $request->file('image')->store('/public/article_images');
          $article->image=$request->file('image')->hashName();
        }
        $article->save();

        return redirect()->route('article.list');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        $own = \Auth::user();
        $replies = $article->replies()->get();
        $goodArticles = $article->usersLiked()->get();

        $goodCount = count($goodArticles); //いいねの数


        $favorite = false; //いいねしているか否か
        if($own){
          foreach ($own->favoriteArticles()->get() as $fArticle){
              if($fArticle->id == $id){
                  $favorite = true;
                  break;
              }
          }
          $login_id = $own->id;
        }else{
          $login_id = null;
        }

        return view('show',['article' => $article, 'login_id' => $login_id,
                            'goodCount' => $goodCount, 'favorite' => $favorite,
                            'replies' => $replies, 'parent' => $article->parent]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $article=Article::find($id);
      $article->delete();
      return redirect()->route('article.list');
    }




    public function replyNew($id)
    {
      return view('reply_new',['parent' => Article::find($id)]);
    }



    public function replyStore(Request $request)
    {
        $own = \Auth::user();

        $request->validate([
            'content' => 'required|max:255',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parent_id' => 'required'
        ]);

        $article= new Article;
        $article->content= $request->input('content');
        $article->user_id=$own->id;
        $article->parent_id = $request->input('parent_id');
        if($request->hasFile('image')){
            $request->file('image')->store('/public/article_images');
            $article->image=$request->file('image')->hashName();
        }
        $article->save();

        return redirect()->route('article.detail',['id' => $article->id]);
    }


    public function search(Request $request){
      $keyword=$request->input('keyword');

      $similars=User::where('name','LIKE','%'.$keyword.'%')->get();
      $articles=Article::where('content','LIKE','%'.$keyword.'%')->get();

      return view('search',['similars' => $similars ,'articles' => $articles]);
    }

    public function image($id){
      $article=Article::find($id);

      return view('article_image',['article' => $article]);
    }
}
