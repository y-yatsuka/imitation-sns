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
    <tr>
      <td>
        <a href={{route('article.detail',['id' => $article->id])}}>
          {!! nl2br(e($article->content)) !!}
        </a>
      </td>
    </tr>
  @endforeach
</table>

@endsection
