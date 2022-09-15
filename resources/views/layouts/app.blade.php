<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>imitation SNS</title>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <style>
      body {padding :80px 80px}
    </style>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/article.css')}}" rel="stylesheet" />
  
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md p-4 navbar-light bg-white fixed-top">

            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/imitationsns_logo.gif') }}" />
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">新規登録</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a  class="nav-link" href="{{ route('user.detail',['user_id' => \Auth::user()->id]) }}" >
                                {{ Auth::user()->name }}
                            </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              ログアウト
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                        </li>
                    @endguest
                </ul>
                @auth
                {{ Form::open(['route' => 'search', 'class'=> 'navbar-form navbar-right form-inline']) }}
                  <div class='form-group'>
                    {{ Form::text('keyword',null,['class' => 'form-control', 'placeholder' => 'ユーザー名またはキーワード', 'size' => '25']) }}
                    {{ Form::submit('検索',['class' => 'btn','id'=> 'search'])}}
                  </div>
                {{ Form::close() }}
                @endauth
            </div>

        </nav>


        <div class='container'>
          @yield('content')
        </div>


    </div>
</body>
</html>
