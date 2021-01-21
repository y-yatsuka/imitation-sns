@extends('layouts.app')

@section('content')
<h1>ユーザー</h1>
<table class='table table-hover table-striped'>
  @foreach($similars as $user)
  <tr>
    <td>
      <a href={{ route('user.detail' , ['user_id' => $user->id]) }}>
        {{ $user->name }}
      </a>
    </td>
    <td>
      {{ $user->introduction }}
    </td>
  </tr>
  @endforeach
</table>
<h1>投稿</h1>
<table class='table table-hover table-striped'>
  @foreach($articles as $article)
  <tr>
    <td>
      <a href={{ route('article.detail' , ['id' => $article->id]) }}>
        {{ $article->content }}
      </a>
    </td>
    <td>
      {{ $article->user->name }}
    </td>
  </tr>
  @endforeach
</table>
@endsection
