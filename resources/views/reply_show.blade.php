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
<h3>{{ $parent->user->name }}</h3>
<p>
  {!! nl2br(e($parent->content)) !!}
</p>
<br />
{{ $parent->user->name }}さんへの返信
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
  <h3>{{ $reply->user->name }}さんへの返信</h3>
  <table class='table table-striped table-hover'>
  @foreach($children as $child)
    <tr>
      <td>
        <a href={{ route('reply.detail', ['reply_id' => $reply->id ]) }}>
          {{ $child->content }}
        <a/>
      </td>
      <td>
        <a href={{ route('user.detail', ['user_id' => $reply->user->id]) }}>
          {{ $child->user->name }}
        </a>
      </td>
    </tr>
  @endforeach
  </table>
  @endif

</div>
@endsection
