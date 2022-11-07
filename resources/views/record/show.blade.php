@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Detalles Ficha <i class="fa-solid fa-circle-info"></i></h1>
        </div>

        <div class="d-flex align-self-center justify-content-center pt-3">
        @include('layouts.alerts')
        </div>

        <div class="container">
            <div class="row justify-content-between">

                <div class="col-8 record-col-show">
                    <div class="row d-flex">
                        <h4> Datos Paciente</h4>
                        <ul class="list-group list-group-horizontal-sm">
                            <li class="list-group-item list-group-item-secondary">Nombre Completo:</li>
                            <li class="list-group-item">{{ $patient->getFriendlyName() }}</li>
                            <li class="list-group-item list-group-item-secondary">Edad:</li>
                            <li class="list-group-item">{{ $patient->getAge() }} años</li>
                            <li class="list-group-item list-group-item-secondary">Género:</li>
                            <li class="list-group-item">{{ $patient->gender }}</li>
                            <li class="list-group-item list-group-item-secondary">Rut:</li>
                            <li class="list-group-item">{{ $patient->rut }}</li>
                        </ul>
                    </div>

                    <div class="row d-flex mt-2">
                        <div class="col-2">
                            <button class="btn btn-secondary" id="collapseBtn" onclick="collapse()" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDetails" aria-expanded="false" aria-controls="collapseDetails">
                                <i class="fas fa-plus"></i> Ver más detalles
                            </button>
                        </div>
                        <div class="collapse" id="collapseDetails">
                            <div class="row d-flex mt-2">
                                <ul class="list-group list-group-horizontal-sm">
                                    <li class="list-group-item list-group-item-secondary">Fecha de nacimiento:</li>
                                    <li class="list-group-item">{{ date('d-m-Y', strtotime($patient->birth_date)) }}</li>
                                    <li class="list-group-item list-group-item-secondary">Correo:</li>
                                    <li class="list-group-item">{{ $patient->email }}</li>
                                    <li class="list-group-item list-group-item-secondary">Cargo:</li>
                                    <li class="list-group-item">{{ $patient->occupation }}</li>
                                </ul>
                            </div>
                            <div class="row d-flex mt-2">
                                <ul class="list-group list-group-horizontal-sm">
                                    <li class="list-group-item list-group-item-secondary">Domicilio:</li>
                                    <li class="list-group-item">{{ $patient->address ? $patient->address : '-' }}</li>
                                    <li class="list-group-item list-group-item-secondary">Ciudad:</li>
                                    <li class="list-group-item">{{ $patient->city ? $patient->city : '-'}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="mt-3 mr-3">
                        <a class="btn btn-secondary ml-2" href="{{ route('record.edit', ['uuid' => $record->uuid]) }}"><i class="fas fa-edit"></i> Editar</a>
                        <a class="btn btn-danger ml-2 text-white" data-bs-toggle="modal" data-bs-target="#delete-record"><i class="fas fa-trash-alt"></i> Borrar</a>
                        <a class="btn btn-primary ml-2" target="_blank" href="{{ route('record.generate', ['uuid' => $record->uuid]) }}"><i class="fas fa-file-pdf"></i> Generar PDF</a>
                    </div>
                </div>

            </div>

            <div class="row justify-content-between mt-3">
                <div class="col-8 record-col-show">
                    <h4>Anamnesis</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Anamnesis Remota</div>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        Actividad Física: <x-markdown>{{ $anamnesis["remote_anamnesis"]["physical_activity"] }}</x-markdown>
                                    </li>
                                    <li class="list-group-item">
                                        Antecedentes Mórbidos: <x-markdown>{{ $anamnesis["remote_anamnesis"]["morbid_background"] }}</x-markdown>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Anamnesis Próxima</div>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        Motivo de Consulta: <x-markdown>{{ $anamnesis["next_anamnesis"]["reason_consultation"] }}</x-markdown>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Evaluación Clínica</div>
                                <ul class="list-group list-group-horizontal-xl">
                                    <li class="list-group-item">
                                        Observación Postural: <x-markdown>{{ $anamnesis["clinical_evaluation"]["postural_observation"] }}</x-markdown>
                                    </li>
                                    <li class="list-group-item">
                                        Palpación: <x-markdown>{{ $anamnesis["clinical_evaluation"]["palpation"] }}</x-markdown>
                                    </li>
                                    <li class="list-group-item">
                                        Flexibilidad: <x-markdown>{{ $anamnesis["clinical_evaluation"]["flexibility"] }}</x-markdown>
                                    </li>
                                </ul>
                                <ul class="list-group list-group-horizontal-xl">
                                    <li class="list-group-item">
                                        Evaluación muscular: <x-markdown>{{ $anamnesis["clinical_evaluation"]["muscle_evaluation"] }}</x-markdown>
                                    </li>
                                    <li class="list-group-item">
                                        Evaluación Neurológica: <x-markdown>{{ $anamnesis["clinical_evaluation"]["neurological_evaluation"] }}</x-markdown>
                                    </li>
                                    <li class="list-group-item">
                                        Pruebas Funcionales: <x-markdown>{{ $anamnesis["clinical_evaluation"]["functional_testing"] }}</x-markdown>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <hr>

            <div class="row d-flex justify-content-between">

                <div class="col-8 record-col-show">
                    <h4>Consultas</h4>
                </div>

                <div class="col-3">
                    <a class="btn btn-tertiary" href="#" data-bs-toggle="modal" data-bs-target="#create-appointment">
                        <i class="fa-solid fa-plus"></i> Agregar consulta
                    </a>
                </div>
            </div>
            
            <div class="container">
                <div class="row">

                    <div class="col align-self-center">

                        @if (count($appointments) > 0)

                        <div class="table-responsive">
                            <table id="detailsTable" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 30%">Fecha Consulta <i class="fas fa-sort" onclick="sortTableWords('detailsTable', 1)"></i></th>
                                        <th style="width: 70%">Evolución</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $appointment)
                                    <tr>
                                        <td>{{ date('d-m-Y', strtotime($appointment->consultation_date)) }}</td>
                                        <td>{{ $appointment->evolution }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-center">
                                {{ $appointments->appends(request()->all())->links() }}
                            </div>
                        </div>

                        @else
                        <h6>No existen consultas creadas aún 🤷‍♀️</h6>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@include('record.delete')
@include('appointment.create')

@if (session()->has('create-modal'))
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#create-appointment").modal('show');
    });
</script>
@endif

@endsection
