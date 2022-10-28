<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('favicon.png') }}" rel="shortcut icon" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fichas Clínicas</title>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

    <!-- Styles -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,300,0,0" />
    <script src="https://kit.fontawesome.com/95e913a4c5.js" crossorigin="anonymous"></script>


</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-purple shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('dashboard')}}">
                    <img src="{{ asset('images/logo-nav.png') }}" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"></ul>

                    @auth
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a  id="nav-item-1" class="nav-link" href="{{ route('dashboard')}}">
                                    <span class="material-symbols-rounded">home</span>Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="nav-item-2" class="nav-link" href="{{ route('records')}}">
                                    <span class="material-symbols-rounded">content_paste</span>
                                    Fichas
                                </a>
                            </li>
                            @if(Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a id="nav-item-3" class="nav-link" href="{{ route('patients')}}">
                                    <span class="material-symbols-rounded">groups</span>
                                    Pacientes
                                </a>
                            </li>
                            @endif
                        </ul>
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->getUserFriendlyIdentifier() }} 
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket"></i> {{ __('Salir') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <div class="container">
        <footer class="py-3 my-4 border-top">
            <p class="text-center text-muted">&copy; 2022 Macarena Gárate</p>
        </footer>
    </div>

    <!-- APP.JS (ALWAYS AFTER JQUERY) -->
    <script type="text/javascript" src="{{ asset('app.js') }}" defer async></script>

</body>

</html>
