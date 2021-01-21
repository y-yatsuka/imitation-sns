@extends('layouts.app')

@section('content')
<h1>フォロー中のアカウント</h1>
<table class='table table-striped table-hover'>
  @foreach($users as $user)
  <tr>
    <td>
      <a href={{ route('user.detail',['user_id' => $user->id ]) }}>
        {{ $user->name }}
      </a>
    </td>
    <td>
      {{ $user->introduction }}
    </td>
  </tr>
  @endforeach
</table>

@endsection
