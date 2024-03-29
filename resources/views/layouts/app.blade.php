<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('../../js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('../../css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                    <a href="{{ route('dashboard.index') }}">
                        <img src="../../images/cdflogo.png" width="75">
                    </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <div class="min-h-screen bg-gray-100">
                            @if(isset(Auth::User()->admin))
                                @if(Auth::User()->isAdmin())
                                    @include('layouts.navigationAdmin')
                                @else
                                    @include('layouts.navigationUser')
                                @endIf
                            @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @if(isset(Auth::User()->admin))
                            <li>
                                <a id="navbarDropdown" class="nav-link dropdown-toggle end-0" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </a>
                        
                        
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if(Auth::User()->admin==1)
                                        <a class="dropdown-item" href="{{ route('reglage') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('reglage-form').submit();">
                                        {{ __('reglage de l\'annee') }}
                                        </a>
                            
                                        <form id="reglage-form" action="{{ route('reglage') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('déconnexion') }}
                                    </a>
                        
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
