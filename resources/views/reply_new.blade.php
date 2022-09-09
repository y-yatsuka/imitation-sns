@extends('layouts.app')

@section('content')
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
@endif
<h1>{{ $parent->user->name }}</h1>
<p>
  {!! nl2br(e($parent->content)) !!}
</p>
<br />
<br />
{{ Form::open(['route' => 'article.reply.store','files' => true]) }}
  <div class='form-group'>
      {!! Form::textarea('content',null, ['class' => 'form-control', 'placeholder' => $parent->user->name.'さんへ返信', 'rows' => 7]) !!}
      {{ Form::label('画像') }}
      {{ Form::file('image') }}
      {{ Form::hidden('parent_id', $parent->id) }}
  </div>
  {{ Form::submit('返信',['class' => 'btn btn-outline-primary']) }}
{{ Form::close()}}
<a class="btn btn-outline-primary" href=javascript:history.back()>戻る</a>
@endsection
