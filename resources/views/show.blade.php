@extends('layouts.app')
<style>
  #fixed{
    position:fixed;
    right:50;
    bottom:60;
  }
</style>
@section('content')
<script src="{{ asset('js/goodFunction.js')}}"></script>
@if($article->user->image!=null)
<img src="{{ asset('storage/profile_images/'.$article->user->id.'.jpeg') }}" class="round-image middle" />
@else
<img src="{{ asset('images/profile_icon.png') }}" class="round-image middle" />
@endif
<h1>{{ $article->user->name }}</h1>
<h3>
  {!! nl2br(e($article->content)) !!}
</h3>
@if($article->image!=null)
<a href="{{ route('article.image',['id' => $article->id]) }} ">
  <div class="image">
      <img src="{{asset('storage/article_images/'.$article->image)}}" />
  </div>
</a>
@endif
<a href=# id='goodCount' onload='goodCount()'>いいね!：{{ $goodCount }}件</a>
<br />
@auth
<button class='btn btn-outline-primary' id='goodButton'>
  @if($favorite)
  いいねを取り消す
  @else
  いいね!
  @endif
</button>
<a class='btn btn-outline-primary' href={{ route('article.reply.new', ['id' => $article->id ]) }}>返信する</a>
@endauth
<input type='hidden' value={{ $article->id }} id='article_id'>
<br />

<div>
  @if($article->user->id === $login_id)
  {{ Form::open(['method' => 'delete', 'route' =>['article.destroy', $article->id]]) }}
    {{ Form::submit('削除', ['class' => 'btn btn-outline-danger']) }}
  {{ Form::close() }}
  @endif

  @if($replies)
  @foreach ($replies as $reply)
    <div class="parent">
      <a href="{{ route('user.detail',['user_id' => $reply->user->id]) }}">
        @if($reply->user->image!=null)
        <img src="{{ asset('storage/profile_images/'.$reply->user->image) }}" class="article-round-image"/>
        @else
        <img src="{{ asset('images/profile_icon.png') }}" class="article-round-image"/>
        @endif
      </a>

      <div class="sentence">
        <a href="{{ route('user.detail',['user_id' => $reply->user->id]) }}">
          <div class="name">
            <h2>
              {{ $reply->user->name }}
            </h2>
          </div>
        </a>
        <a href="{{ route('reply.detail',['reply_id' => $reply->id])}}">
          <div class="content">
            <p>
              {!! nl2br(e($reply->content)) !!}
            </p>
          </div>
        </a>
      </div>
    </div>
  @endforeach
  @endif
</div>
<a class='btn btn-outline-primary' href="javascript:history.back()" id='fixed'>戻る</a>
@endsection
