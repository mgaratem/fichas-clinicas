@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Editar Ficha</h1>
      </div>

      <div class="d-flex align-self-center justify-content-center pt-3">
      @include('layouts.alerts')
      </div>

      <div class="container">

        <div class="row">
          <div class="col-3 offset-md-1">
            <a class="btn btn-lg btn-secondary" href="{{ route('record.show', ['uuid' => $record->uuid]) }}">
              <i class="fa-solid fa-arrow-left-long"></i> Volver
            </a>
          </div>
        </div>

        <div class="row">
          <div class="col-md-9 offset-md-2 record-edit-form">
            <form method="post" action="{{ route('record.update', ['record' => $record]) }}" novalidate>
              @csrf

              <h5>Anamnesis Remota</h5>

              <div class="row pb-3">
                <div class="col-6">
                  <label for="name">Actividad Física:</label>
                  <textarea class="form-control" name="physical_activity" rows="3" required>{{ old('physical_activity') ? old('physical_activity') : json_decode($record->anamnesis, true)["remote_anamnesis"]["physical_activity"] }}</textarea>
                  @error('physical_activity')
                  <span class="text-danger">Debes ingresar un input válido</span>
                  @enderror
                </div>

                <div class="col-6">
                  <label for="name">Actividad Física:</label>
                  <textarea class="form-control" name="morbid_background" rows="3" required>{{ old('morbid_background') ? old('morbid_background') : json_decode($record->anamnesis, true)["remote_anamnesis"]["morbid_background"] }}</textarea>
                  @error('morbid_background')
                  <span class="text-danger">Debes ingresar un input válido</span>
                  @enderror
                </div>
              </div>

              <hr>

              <h5>Anamnesis Próxima</h5>

              <div class="row pb-3">
                <div class="col-6">
                  <label for="name">Motivo de Consulta:</label>
                  <textarea class="form-control" name="reason_consultation" rows="5" required>{{ old('reason_consultation') ? old('reason_consultation') : json_decode($record->anamnesis, true)["next_anamnesis"]["reason_consultation"] }}</textarea>
                  @error('reason_consultation')
                  <span class="text-danger">Debes ingresar un input válido</span>
                  @enderror
                </div>
              </div>

              <hr>

              <h5>Evaluación Clínica</h5>

              <div class="row pb-3">
                <div class="col-4">
                  <label for="name">Observación Postural:</label>
                  <textarea class="form-control" name="postural_observation" rows="3" required>{{ old('postural_observation') ? old('postural_observation') : json_decode($record->anamnesis, true)["clinical_evaluation"]["postural_observation"] }}</textarea>
                  @error('postural_observation')
                  <span class="text-danger">Debes ingresar un input válido</span>
                  @enderror
                </div>

                <div class="col-4">
                  <label for="name">Palpación:</label>
                  <textarea class="form-control" name="palpation" rows="3" required>{{ old('palpation') ? old('palpation') : json_decode($record->anamnesis, true)["clinical_evaluation"]["palpation"] }}</textarea>
                  @error('palpation')
                  <span class="text-danger">Debes ingresar un input válido</span>
                  @enderror
                </div>

                <div class="col-4">
                  <label for="name">Flexibilidad:</label>
                  <textarea class="form-control" name="flexibility" rows="3" required>{{ old('flexibility') ? old('flexibility') : json_decode($record->anamnesis, true)["clinical_evaluation"]["flexibility"] }}</textarea>
                  @error('flexibility')
                  <span class="text-danger">Debes ingresar un input válido</span>
                  @enderror
                </div>
              </div>

              <div class="row pb-3">
                <div class="col-4">
                  <label for="name">Evaluación Muscular:</label>
                  <textarea class="form-control" name="muscle_evaluation" rows="3" required>{{ old('muscle_evaluation') ? old('muscle_evaluation') : json_decode($record->anamnesis, true)["clinical_evaluation"]["muscle_evaluation"] }}</textarea>
                  @error('muscle_evaluation')
                  <span class="text-danger">Debes ingresar un input válido</span>
                  @enderror
                </div>

                <div class="col-4">
                  <label for="name">Evaluación Neurológica:</label>
                  <textarea class="form-control" name="neurological_evaluation" rows="3" required>{{ old('neurological_evaluation') ? old('neurological_evaluation') : json_decode($record->anamnesis, true)["clinical_evaluation"]["neurological_evaluation"] }}</textarea>
                  @error('neurological_evaluation')
                  <span class="text-danger">Debes ingresar un input válido</span>
                  @enderror
                </div>

                <div class="col-4">
                  <label for="name">Pruebas Funcionales:</label>
                  <textarea class="form-control" name="functional_testing" rows="3" required>{{ old('functional_testing') ? old('functional_testing') : json_decode($record->anamnesis, true)["clinical_evaluation"]["functional_testing"] }}</textarea>
                  @error('functional_testing')
                  <span class="text-danger">Debes ingresar un input válido</span>
                  @enderror
                </div>
              </div>

              <hr>

              <div class="form-button">
                <div class="row">
                  <div class="col-md-6 offset-md-5">
                    <button class="btn btn-lg btn-primary" type="submit">
                        {{ __('Actualizar') }}
                    </button>
                  </div>
                </div>
              </div>


            </form>
          </div>
        </div>
      </div>

    </div>
</div>
@endsection