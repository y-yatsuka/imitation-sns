@extends('layouts.app')

@section('content')
<h1>フォロー中のアカウント</h1>
<table class='table table-striped table-hover'>
  @foreach($users as $user)
    <div class="parent">
      <a href="{{ route('user.detail',['user_id' => $user->id]) }}">
        @if($user->image!=null)
        <img src="{{ asset('storage/profile_images/'.$user->image) }}" class="article-round-image"/>
        @else
        <img src="{{ asset('images/profile_icon.png') }}" class="article-round-image"/>
        @endif
      </a>

      <div class="sentence">
        <a href="{{ route('user.detail',['user_id' => $user->id]) }}">
          <div class="name">
            <h2>
              {{ $user->name }}
            </h2>
          </div>
          <div class="content">
            <p>
              {!! nl2br(e($user->introduction)) !!}
            </p>
          </div>
        </a>
      </div>
    </div>
  @endforeach
</table>

@endsection
