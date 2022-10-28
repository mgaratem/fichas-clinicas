@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Pacientes</h1>
        </div>

        <div class="container-fluid pt-2 my-5">
            <div class="row justify-content-md-center">
                <div class="col-11">
                    <div class="table-responsive">
                        @if (isset($patients))
                            <table class="table table-striped table-bordered">
                                <thead class="table align-middle">
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre Completo</th>
                                    <th scope="col">Rut</th>
                                    <th scope="col">Creado en</th>
                                    <th scope="col">Acciones</th>
                                </thead>
                                <tbody>
                                @foreach ($patients as $patient)
                                    <tr>
                                        <td>{{ $patient->id }}</td>
                                        <td>{{ $patient->getFriendlyName() }}</td>
                                        <td>{{ $patient->rut }}</td>
                                        <td>{{ $patient->created_at ? $patient->created_at : '-' }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="#">
                                                ---
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-center">
                                {{ $patients->appends(request()->all())->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    var item = document.getElementById("nav-item-3");
    item.classList.add("active");
</script>
@endsection
