@extends('layouts.app')

@section('content')
<h1>ユーザー</h1>
<table class='table table-hover table-striped'>
  @foreach($similars as $user)
    <div class="parent">
      <a href="{{ route('user.detail',['user_id' => $user->id]) }}">
        @if($user->image!=null)
        <img src="{{ asset('storage/profile_images/'.$user->image) }}" class="article-round-image"/>
        @else
        <img src="{{ asset('images/profile_icon.png') }}" class="article-round-image"/>
        @endif
      </a>

      <div class="sentence">
        <a href="{{ route('user.detail',['user_id' => $user->id]) }}">
          <div class="name">
            <h2>
              {{ $user->name }}
            </h2>
          </div>
          <div class="content">
            <p>
              {!! nl2br(e($user->introduction)) !!}
            </p>
          </div>
        </a>
      </div>
    </div>
  @endforeach
</table>
<h1>投稿</h1>
<table class='table table-hover table-striped'>
  @foreach($articles as $article)
    <div class="parent">
      <a href="{{ route('user.detail',['user_id' => $article->user->id]) }}">
        @if($article->user->image!=null)
        <img src="{{ asset('storage/profile_images/'.$article->user->image) }}" class="article-round-image"/>
        @else
        <img src="{{ asset('images/profile_icon.png') }}" class="article-round-image"/>
        @endif
      </a>

      <div class="sentence">
        <a href="{{ route('user.detail',['user_id' => $article->user->id]) }}">
          <div class="name">
            <h2>
              {{ $article->user->name }}
            </h2>
          </div>
        </a>
        <a href="{{ route('article.detail',['id' => $article->id])}}">
          <div class="content">
            <p>
              {!! nl2br(e($article->content)) !!}
            </p>
          </div>

        </a>
      </div>
    @if($article->image!=null)
    <a href="{{ route('article.image',['id' => $article->id]) }} ">
      <div class="image">
          <img src="{{asset('storage/article_images/'.$article->image)}}" />
      </div>
    </a>
    @endif
  </div>
@endforeach
</table>
@endsection
