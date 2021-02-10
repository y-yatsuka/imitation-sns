<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/articles');
});


Auth::routes();

//Ajax
  Route::post('/article/good', 'Ajax\ContactController@goodFunction')->name('article.good');
  Route::post('/article/good/count', 'Ajax\ContactController@goodCount')->name('article.good.count');
  Route::post('/user/follow', 'Ajax\ContactController@followFunction')->name('user.follow');
  Route::post('/reply/good', 'Ajax\ContactController@replyGoodFunction')->name('reply.good');
  Route::post('/reply/good/count', 'Ajax\ContactController@replyGoodCount')->name('reply.good.count');

Route::group(['middleware'=>['auth']],function(){
  
  //Article
  Route::get('/articles', 'ArticleController@index')->name('article.list');
  Route::get('/home','HomeController@index')->name('home');
  Route::get('/article/new', 'ArticleController@create')->name('article.new');
  Route::post('/article', 'ArticleController@store')->name('article.store');
  Route::get('/article/edit/{id}', 'ArticleController@edit')->name('article.edit');
  Route::post('/article/update/{id}', 'ArticleController@update')->name('article.upadate');
  Route::get('/article/{id}', 'ArticleController@show')->name('article.detail');
  Route::delete('/article/{id}', 'ArticleController@destroy')->name('article.destroy');
  Route::get('/article/reply/new/{id}', 'ArticleController@replyNew')->name('article.reply.new');
  Route::post('/article/reply/store', 'ArticleController@replyStore')->name('article.reply.store');
  Route::get('/article/image/{id}', 'ArticleController@image')->name('article.image');

  //User
  Route::get('/user/edit', 'UserController@edit')->name('user.edit');
  Route::post('/user/update', 'UserController@update')->name('user.update');
  Route::get('/user/follow/list/{user_id}', 'UserController@followList')->name('user.follow.list');
  Route::get('/user/follower/list/{user_id}', 'UserController@followerList')->name('user.follower.list');
  Route::get('/user/{user_id}', 'UserController@show')->name('user.detail');

  //Reply
  Route::get('/reply/show/{reply_id}', 'ReplyController@show')->name('reply.detail');
  Route::get('/reply/new/{reply_id}', 'ReplyController@create')->name('reply.new');
  Route::post('/reply/store', 'ReplyController@store')->name('reply.store');
  Route::delete('/reply/{reply_id}', 'ReplyController@destroy')->name('reply.destroy');

  Route::post('/search','ArticleController@search')->name('search');


});
