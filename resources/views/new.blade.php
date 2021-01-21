@extends('layouts.app')

@section('content')
{{ Form::open(['route' => 'article.store']) }}
  <div class='form-group'>
    {!! Form::textarea('content',null, ['class' => 'form-control', 'placeholder' => '今何をしていますか？','rows' => 7]) !!}
  </div>
  @if($message)
    <div >
      {{ $message }}
    </div>
  @endif
  {{ Form::submit('投稿',['class' => 'btn btn-outline-primary']) }}
  <a class="btn btn-outline-primary" href=javascript:history.back()>戻る</a>
{{ Form::close()}}

@endsection
