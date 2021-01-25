@extends('layouts.app')

@section('content')
<h1>{{ $article->user->name }}</h1>
<p>
  {!! nl2br(e($article->content)) !!}
</p>
<br />
<br />
{{ Form::open(['route' => 'article.reply.store']) }}
  <div class='form-group'>
    {!! Form::textarea('content',null, ['class' => 'form-control', 'placeholder' => $article->user->name.'さんへ返信', 'rows' => 7]) !!}
    {{ Form::hidden('id', $article->id)}}
  </div>
  @if($message)
    <div >
      {{ $message }}
    </div>
  @endif
  {{ Form::submit('投稿',['class' => 'btn btn-outline-primary']) }}
{{ Form::close()}}
<a class="btn btn-outline-primary" href=javascript:history.back()>戻る</a>
@endsection
