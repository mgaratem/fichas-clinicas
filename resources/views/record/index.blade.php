@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Fichas</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a class="btn btn-primary" href="{{ route('record.create') }}">
                        <i class="fas fa-plus-circle"></i> Crear nueva ficha
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid pt-2 my-5">

            <div class="row justify-content-md-center">

                @include('layouts.alerts')

                <div class="col-11">
                    <div class="table-responsive">
                        @if (isset($records))
                            <table class="table table-striped table-bordered">
                                <thead class="table align-middle">
                                    <th scope="col">Nº</th>
                                    <th scope="col">Nombre Completo</th>
                                    <th scope="col">Rut</th>
                                    <th scope="col">Última Actualización</th>
                                    <th scope="col">Acciones</th>
                                </thead>
                                <tbody>
                                <?php $i = 0; ?>
                                @foreach ($records as $record)
                                    <?php $i++; ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td>{{ $record->patient->getFriendlyName() }}</td>
                                        <td>{{ $record->patient->rut }}</td>
                                        <td>{{ $record->updated_at ? $record->updated_at : '-' }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('record.show', ['uuid' => $record->uuid]) }}">
                                                Ver Ficha
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-center">
                                {{ $records->appends(request()->all())->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    var item = document.getElementById("nav-item-2");
    item.classList.add("active");
</script>
@endsection
