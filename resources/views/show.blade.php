@extends('layouts.app')
<style>
  #fixed{
    position:fixed;
    right:50;
    bottom:60;
  }

</style>

@section('script')
    <script defer src="{{ asset('js/goodFunction.js')}}"></script>
@endsection

@section('content')
@if($parent)
    <div class="article-show">
        <div class="inner">
            <a href="{{ route('user.detail',['user_id' => $parent->user->id]) }}">
                @if($parent->user->image!=null)
                    <img src="{{ asset('storage/profile_images/'.$parent->user->id.'.jpeg') }}" class="round-image small" />
                @else
                    <img src="{{ asset('images/profile_icon.png') }}" class="round-image small" />
                @endif
            </a>
            <a href="{{ route('user.detail',['user_id' => $parent->user->id]) }}">
                <h3>{{ $parent->user->name }}</h3>
            </a>
            <a href="{{ route('article.detail', ['article_id' => $parent->id ]) }}">
                <p>
                    {!! nl2br(e($parent->content)) !!}
                </p>
            </a>
        </div>
        @if($parent->image!==null)
            <a href="{{ route('article.image',['id' => $parent->id]) }} ">
                <div class="small-image">
                    <img src="{{asset('storage/article_images/'.$parent->image)}}" />
                </div>
            </a>
        @endif
    </div>
@endif
<div class="article-show">
  <div class="inner">
    <a href="{{ route('user.detail',['user_id' => $article->user->id]) }}">
      @if($article->user->image!=null)
      <img src="{{ asset('storage/profile_images/'.$article->user->id.'.jpeg') }}" class="round-image middle" />
      @else
      <img src="{{ asset('images/profile_icon.png') }}" class="round-image middle" />
      @endif
    </a>
    <a href="{{ route('user.detail',['user_id' => $article->user->id]) }}">
      <h1>{{ $article->user->name }}</h1>
    </a>
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
  </div>
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
  <a class='btn btn-outline-primary' href={{ route('article.reply.new', ['parent_id' => $article->id ]) }}>返信する</a>
  @if($article->user->id === $login_id)
  {{ Form::open(['method' => 'delete', 'route' =>['article.destroy', $article->id]]) }}
    {{ Form::submit('削除', ['class' => 'btn btn-outline-danger']) }}
  {{ Form::close() }}
  @endif
  @endauth
</div>
<input type='hidden' value={{ $article->id }} id='article_id'>
<br />
<div>
  <h3>{{$article->user->name}}さんへの返信一覧</h3>
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
        <a href="{{ route('article.detail',['reply_id' => $reply->id])}}">
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
