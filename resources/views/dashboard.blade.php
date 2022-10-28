@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>

            <div class="container py-4">
                <div class="row align-items-md-stretch">
                    <div class="col-md-8">
                        <div class="p-5 mb-4rounded-3">
                            <div class="container-fluid py-5">
                                <h1 class="display-5 fw-bold">Bienvenido ✨</h1>
                                <p class="col-md-8 fs-4">
                                    Haz click en la sección "Fichas" en la barra de navegación o en el botón a continuación para poder visualizar
                                    las fichas clínicas disponibles de tus pacientes.
                                </p>
                                <a class="btn btn-primary btn-lg" href="{{ route('records')}}">Ver tus fichas</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img class="img-responsive dashboard" src="{{ asset('images/remote-work-woman.svg')}}">
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        var item = document.getElementById("nav-item-1");
        item.classList.add("active");
    </script>
@endsection
