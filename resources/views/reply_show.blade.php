@extends('layouts.app')
<style>
  #fixed{
    position:fixed;
    right:50;
    bottom:60;
  }
</style>

@section('content')
<script src={{ asset('js/replyGoodFunction.js')}}></script>
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
    @if($flag)
    <a href="{{ route('article.detail', ['article_id' => $parent->id ]) }}">
      <p>
        {!! nl2br(e($parent->content)) !!}
      </p>
    </a>
    @else
    <a href="{{ route('reply.detail', ['reply_id' => $parent->id ]) }}">
      <p>
        {!! nl2br(e($parent->content)) !!}
      </p>
    </a>
    @endif
  </div>
    @if($parent->image!==null)
    <a href="{{ route('article.image',['id' => $parent->id]) }} ">
      <div class="small-image">
          <img src="{{asset('storage/article_images/'.$parent->image)}}" />
      </div>
    </a>
    @endif
</div>

<div class="article-show">
  <h3>
    {{ $parent->user->name }}さんへの返信
  </h3>
  <div class="inner">
    <a href="{{ route('user.detail',['user_id' => $reply->user->id]) }}">
      @if($reply->user->image!=null)
      <img src="{{ asset('storage/profile_images/'.$reply->user->id.'.jpeg') }}" class="round-image middle" />
      @else
      <img src="{{ asset('images/profile_icon.png') }}" class="round-image middle" />
      @endif
    </a>
    <a href="{{ route('user.detail',['user_id' => $reply->user->id]) }}">
      <h1>{{ $reply->user->name }}</h1>
    </a>
    <h3>
      {!! nl2br(e($reply->content)) !!}
    </h3>
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
  <a class='btn btn-outline-primary' href={{ route('reply.new', ['id' => $reply->id ]) }} >返信する</a>
  @if($reply->user->id === $login_id)
  {{ Form::open(['method' => 'delete', 'route' =>['reply.destroy', $reply->id]]) }}
    {{ Form::submit('削除', ['class' => 'btn btn-outline-danger']) }}
  {{ Form::close() }}
  @endif
  <a class='btn btn-outline-primary' href="javascript:history.back()" id='fixed'>戻る</a>
  @endauth
</div>

<input type='hidden' value={{ $reply->id }} id='reply_id'>
<br />

<div>
  <h3>{{$reply->user->name}}さんへの返信一覧</h3>
  @if(count($children))
  <table class='table table-striped table-hover'>
  @foreach($children as $child)
  <div class="parent">
    <a href="{{ route('user.detail',['user_id' => $child->user->id]) }}">
      @if($child->user->image!=null)
      <img src="{{ asset('storage/profile_images/'.$child->user->image) }}" class="article-round-image"/>
      @else
      <img src="{{ asset('images/profile_icon.png') }}" class="article-round-image"/>
      @endif
    </a>

    <div class="sentence">
      <a href="{{ route('user.detail',['user_id' => $child->user->id]) }}">
        <div class="name">
          <h2>
            {{ $child->user->name }}
          </h2>
        </div>
      </a>
      <a href="{{ route('reply.detail', ['reply_id' => $child->id ]) }}">
        <div class="content">
          <p>
            {!! nl2br(e($child->content)) !!}
          </p>
        </div>

      </a>
    </div>
  @endforeach
  </table>
  @endif

</div>
@endsection
