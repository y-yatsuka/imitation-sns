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
@if($parent->user->image!=null)
<img src="{{ asset('storage/profile_images/'.$parent->user->id.'.jpeg') }}" class="round-image small" />
@else
<img src="{{ asset('images/profile_icon.png') }}" class="round-image small" />
@endif
<h3>{{ $parent->user->name }}</h3>
<p>
  {!! nl2br(e($parent->content)) !!}
</p>
@if($flag)
  @if($parent->image!==null)
  <a href="{{ route('article.image',['id' => $parent->id]) }} ">
    <div class="image">
        <img src="{{asset('storage/article_images/'.$parent->image)}}" />
    </div>
  </a>
  @endif
@endif
<br />

<div>
  <p>
    {{ $parent->user->name }}さんへの返信
  </p>
</div>
@if($reply->user->image!=null)
<img src="{{ asset('storage/profile_images/'.$reply->user->id.'.jpeg') }}" class="round-image middle" />
@else
<img src="{{ asset('images/profile_icon.png') }}" class="round-image middle" />
@endif
<h1>{{ $reply->user->name }}</h1>
<h3>
  {!! nl2br(e($reply->content)) !!}
</h3>
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
@endauth
<input type='hidden' value={{ $reply->id }} id='reply_id'>
<br />

<div>
  @auth
  @if($reply->user->id === $login_id)
  {{ Form::open(['method' => 'delete', 'route' =>['reply.destroy', $reply->id]]) }}
    {{ Form::submit('削除', ['class' => 'btn btn-outline-danger']) }}
  {{ Form::close() }}
  @endif
  <a class='btn btn-outline-primary' href="javascript:history.back()" id='fixed'>戻る</a>
  @endauth

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
