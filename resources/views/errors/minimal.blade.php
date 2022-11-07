<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="{{ asset('favicon.png') }}" rel="shortcut icon" type="image/x-icon">

        <title>@yield('title')</title>

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
                    </div>
            </nav>

            <main class="main flex-shrink-0 pt-5 mt-5">
                <div class="container pb-5">
                    <div class="row">
                        <div class="col d-flex justify-content-center">
                            <img class="img-fluid" src="images/error-page.png" alt="error" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex-justify-content-center">
                            <h1 class="text-center fw-400">Ups! @yield('code') | @yield('message')</h1>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    
        <div class="container">
            <footer class="py-3 my-4 border-top">
                <p class="text-center text-muted">&copy; 2022 Macarena Gárate</p>
            </footer>
        </div>
    </body>
</html>
