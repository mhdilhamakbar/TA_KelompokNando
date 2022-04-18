<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <?php 
        $route = Route::currentRouteName(); 
    ?>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    @if($route == 'login')
        <link rel="stylesheet" href="{{ asset('auth/css/style.css') }}">
    @endif
    @if ($route == 'register')
        <link rel="stylesheet" href="{{ asset('auth/css/style2.css') }}">
    @endif
</head>
<body>
    @if (count($errors->all()) > 0)
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @elseif (Session::has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session('success')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    <div id="app">
        @if($route != 'login' and $route != 'register')
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'General Affair Apps') }}
                    </a>
                </div>
            </nav>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('auth/js/jquery.min.js') }}"></script>
    <script src="{{ asset('auth/js/popper.js') }}"></script>
    <script src="{{ asset('auth/js/bootstrap.min.js')}}"></script>
    @if ($route == 'login')
        <script src="{{ asset('auth/js/main.js') }}"></script>    
    @endif
    @if ($route == 'register')        
        <script src="{{ asset('auth/js/main2.js') }}"></script>    
    @endif
</body>
</html>
