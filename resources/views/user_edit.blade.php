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
  {{ Form::model($own, ['route' => 'user.update','files' => true]) }}
    <div class="form-group">
      {{ Form::label('プロフィール画像')}}
      <br />
      {{ Form::file('image') }}
    </div>
    <div class="form-group">
      {{Form::label('name','ユーザー名') }}
      <br />
      {{ Form::text('name',null,['class' => 'form-control']) }}
    </div>
    <div class="form-group">
      {{ Form::label('自己紹介')}}
      <br />
      {!! Form::textarea('introduction',null,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
      {{ Form::submit('編集', ['class' => 'btn btn-outline-primary'])}}
      <button class="btn btn-outline-primary" href="javascript:history.back()">戻る</button>
    </div>
  {{ Form::close() }}
@endsection
