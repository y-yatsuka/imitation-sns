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


Route::group(['middleware'=>['auth']],function(){
    //Ajax
    Route::post('/article/good', 'Ajax\ContactController@goodFunction');
    Route::post('/article/good/count', 'Ajax\ContactController@goodCount');
    Route::post('/user/follow', 'Ajax\ContactController@followFunction');

  //Article
  Route::get('/articles', 'ArticleController@index')->name('article.list');
  Route::get('/home','HomeController@index')->name('home');
  Route::get('/article/new', 'ArticleController@create')->name('article.new');
  Route::post('/article', 'ArticleController@store')->name('article.store');
  Route::get('/article/edit/{id}', 'ArticleController@edit')->name('article.edit');
  Route::post('/article/update/{id}', 'ArticleController@update')->name('article.upadate');
  Route::get('/article/{id}', 'ArticleController@show')->name('article.detail');
  Route::delete('/article/{id}', 'ArticleController@destroy')->name('article.destroy');
  Route::get('/article/image/{id}', 'ArticleController@image')->name('article.image');
  Route::get('/article/new/{parent_id}', 'ArticleController@replyNew')->name('article.reply.new');
  Route::post('/article/reply', 'ArticleController@replyStore')->name('article.reply.store');

  //User
  Route::get('/user/edit', 'UserController@edit')->name('user.edit');
  Route::post('/user/update', 'UserController@update')->name('user.update');
  Route::get('/user/follow/list/{user_id}', 'UserController@followList')->name('user.follow.list');
  Route::get('/user/follower/list/{user_id}', 'UserController@followerList')->name('user.follower.list');
  Route::get('/user/{user_id}', 'UserController@show')->name('user.detail');


  Route::post('/search','ArticleController@search')->name('search');


});
