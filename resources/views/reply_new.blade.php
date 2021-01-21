@extends('layouts.app')

@section('content')
<h1>{{ $reply->user->name }}</h1>
<p>
  {!! nl2br(e($reply->content)) !!}
</p>
<br />
<br />
{{ Form::open(['route' => 'reply.store']) }}
  <div class='form-group'>
    {!! Form::textarea('content',null, ['class' => 'form-control', 'placeholder' => $reply->user->name.'さんへ返信', 'rows' => 7]) !!}
    {{ Form::hidden('id', $reply->id)}}
  </div>
  @if($message)
    <div >
      {{ $message }}
    </div>
  @endif
  {{ Form::submit('返信',['class' => 'btn btn-outline-primary']) }}
  <a class="btn btn-outline-primary" href=javascript:history.back()>戻る</a>
{{ Form::close()}}
@endsection
