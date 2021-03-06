<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token" />
    <title>{{ config('app.name', 'Task Manager') }}</title>
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ secure_asset('js/app.js') }}" defer></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Task Manager') }}
                </a>                
                    
       
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('tasks.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('tasks.index') }}">{{ __('Tasks') }}</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('task_statuses.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('task_statuses.index') }}">{{ __('Statuses') }}</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('users.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('users.index') }}">{{ __('Users') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>                                

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>                                    
                                </div>
                            </li>
                           
                           <a class="nav-link" href="{{ route('account.index') }}">{{ __('My account') }}</a>
                        @endguest
                    </ul>
                </div>
            </div>            
        </nav>

        <main class="py-4">
            <div class="text-center">@include('flash::message')</div>
            @yield('content')
        </main>    
     
    <script src="//code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(function(){
          $(".alert").delay(1500).slideUp(300);
    });
</script> 
</body>
</html>
