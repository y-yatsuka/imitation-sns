@extends('layouts.app')
@section('content')
<script src="{{ asset('js/followFunction.js')}}"></script>

@if($user->image!=null)
<img src="{{ asset('storage/profile_images/'.$user->id.'.jpeg') }}" class="round-image large" />
@else
<img src="{{ asset('images/profile_icon.png') }}" class="round-image large" />
@endif
<h1>{{ $user->name }}</h1>
<div class="well">
  <h3>自己紹介</h3>
  <p>
    @if($user->introduction)
      {!! nl2br(e($user->introduction)) !!}
    @else
      自己紹介が記入されていません
    @endif
  </p>
  @auth
    @if($user->id == $own->id)
      <a class="btn btn-outline-primary" href={{ route('user.edit')}}>プロフィールを編集する</a>
    @else
      <button class= "btn btn-outline-primary" id="btn">
        @if($following)
        フォローをはずす
        @else
          フォローする
        @endif
      </button>

    @endif
  @endauth
  <input type="hidden" value={{ $user->id }} id="user_id"/>
  <input type="hidden" valuse={{ $following }} id="following"/>
  <p>
    <a href={{ route('user.follow.list',['user_id' => $user->id])}} >
      フォロー中:{{ $follows_count }}
    </a>
    |
    <a href={{ route('user.follower.list', ['user_id' => $user->id ]) }} >
      フォロワー:{{ $followers_count }}
    </a>

  </p>

</div>
<br />
<table class="table table-striped table-hover">
  @foreach($user_articles as $article)
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
