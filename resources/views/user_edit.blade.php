@extends('layouts.app')

@section('content')
  {{ Form::model($own, ['route' => ['user.update']]) }}
    <div class="form-group">
      {{Form::label('name','ユーザー名')}}
      <br />
      {{ Form::text('name',null) }}
    </div>
    <div class="form-group">
      {{ Form::label('introduction')}}
      <br />
      {!! Form::textarea('introduction',null) !!}
    </div>
    <div class="form-group">
      {{ Form::submit('編集', ['class' => 'btn btn-outline-primary'])}}
      <button class="btn btn-outline-primary" href="javascript:history.back()">戻る</button>
    </div>
  {{ Form::close() }}
@endsection
