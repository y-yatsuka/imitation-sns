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

{{ Form::open(['route' => 'article.store','files' => true]) }}
  <div class='form-group'>
    {!! Form::textarea('content',null, ['class' => 'form-control', 'placeholder' => '今何をしていますか？','rows' => 7]) !!}
  </div>
  {{ Form::label('画像') }}
  <div class='form-group'>
    {{ Form::file('image') }}
  </div>
  {{ Form::submit('投稿',['class' => 'btn btn-outline-primary']) }}
  <a class="btn btn-outline-primary" href=javascript:history.back()>戻る</a>
{{ Form::close()}}

@endsection
