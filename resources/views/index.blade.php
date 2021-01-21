
<style>
  #fixed{
    position:fixed;
    right:50;
    bottom:60;
  }
</style>
@extends('layouts.app')

@section('content')
  <h1>投稿</h1>

  <table class='table table-striped table-hover'>
    @foreach ($articles as $article)

      <tr>
        <td class="linkBlock">
          <a class="link" href='{{ route('article.detail', ['id' => $article->id]) }}'>
              {!! nl2br(e($article->content)) !!}
          </a>
        </td>
        <td class="linkBlock">
          <a class="link" href='{{ route('user.detail', ['user_id' => $article->user->id]) }}'>
          {{ $article->user->name }}
        </a>
        </td>
      </tr>
    @endforeach
  </table>
  @auth

    <div>
      <a class='btn btn-primary btn-lg' id='fixed' href={{ route('article.new') }}>新規作成</a>
    </div>
  @endauth
@endsection
