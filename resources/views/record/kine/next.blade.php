@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Crear ficha</h1>
        </div>

        <div class="d-flex align-self-center justify-content-center pt-3">
            @include('layouts.alerts')
        </div>

        <div class="form-card-container">
            <div class="form-card">
                <div class="form-card-header">
                    <h1>Anamnesis</h1>
                </div>

                <div class="form-card-body">
                    <form class="form-card" action="{{ route('record.store') }}" method="POST" novalidate>
                        @csrf

                        <h4>Anamnesis Remota</h4>

                        <div class="row">

                            <div class="col-6">
                                <div class="form-item">
                                    <label class="form-label" for="physical_activity">Actividad Física</label>
                                    <textarea name="physical_activity" placeholder="" rows="3">{{ old('physical_activity') }}</textarea>
                                    @error('physical_activity')
                                    <span class="text-danger">Ingrese información</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-item">
                                    <label class="form-label" for="morbid_background">Antecedentes Mórbidos</label>
                                    <textarea name="morbid_background" placeholder="" rows="3">{{ old('morbid_background') }}</textarea>
                                    @error('morbid_background')
                                    <span class="text-danger">Ingrese información</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <h4>Anamnesis Próxima</h4>

                        <div class="form-item">
                            <label class="form-label" for="reason_consultation">Motivo Consulta</label>
                            <textarea name="reason_consultation" placeholder="" rows="2">{{ old('reason_consultation') }}</textarea>
                            @error('reason_consultation')
                            <span class="text-danger">Ingrese información</span>
                            @enderror
                        </div>

                        <h4>Evaluación Clínica</h4>

                        <div class="row">
                            <div class="col-6">

                                <div class="form-item">
                                    <label class="form-label" for="postural_observation">Observación Postural</label>
                                    <textarea name="postural_observation" placeholder="" rows="3">{{ old('postural_observation') }}</textarea>
                                    @error('postural_observation')
                                    <span class="text-danger">Ingrese información</span>
                                    @enderror
                                </div>

                                <div class="form-item">
                                    <label class="form-label" for="flexibility">Flexibilidad</label>
                                    <textarea name="flexibility" placeholder="" rows="3">{{ old('flexibility') }}</textarea>
                                    @error('flexibility')
                                    <span class="text-danger">Ingrese información</span>
                                    @enderror
                                </div>

                                <div class="form-item">
                                    <label class="form-label" for="neurological_evaluation">Evaluación Neurológica</label>
                                    <textarea name="neurological_evaluation" placeholder="" rows="3">{{ old('neurological_evaluation') }}</textarea>
                                    @error('neurological_evaluation')
                                    <span class="text-danger">Ingrese información</span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-6">

                                <div class="form-item">
                                    <label class="form-label" for="palpation">Palpación</label>
                                    <textarea name="palpation" placeholder="" rows="3">{{ old('palpation') }}</textarea>
                                    @error('palpation')
                                    <span class="text-danger">Ingrese información</span>
                                    @enderror
                                </div>

                                <div class="form-item">
                                    <label class="form-label" for="muscle_evaluation">Evaluación Muscular</label>
                                    <textarea name="muscle_evaluation" placeholder="" rows="3">{{ old('muscle_evaluation') }}</textarea>
                                    @error('muscle_evaluation')
                                    <span class="text-danger">Ingrese información</span>
                                    @enderror
                                </div>

                                <div class="form-item">
                                    <label class="form-label" for="functional_testing">Pruebas Funcionales</label>
                                    <textarea name="functional_testing" placeholder="" rows="3">{{ old('functional_testing') }}</textarea>
                                    @error('functional_testing')
                                    <span class="text-danger">Ingrese información</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <input type="hidden" name="name" value="{{ $userData['name'] }}" required>
                        <input type="hidden" name="paternal_name" value="{{ $userData['paternal_name'] }}" required>
                        <input type="hidden" name="maternal_name" value="{{ $userData['maternal_name'] }}" required>
                        <input type="hidden" name="rut" value="{{ $userData['rut'] }}" required>
                        <input type="hidden" name="gender" value="{{ $userData['gender'] }}" required>
                        <input type="hidden" name="birth_date" value="{{ $userData['birth_date'] }}" required>
                        <input type="hidden" name="occupation" value="{{ $userData['occupation'] }}" required>
                        <input type="hidden" name="address" value="{{ $userData['address'] }}" required>
                        <input type="hidden" name="city" value="{{ $userData['city'] }}" required>
                        <input type="hidden" name="email" value="{{ $userData['email'] }}" required>


                        <div class="form-button">
                            <div class="row">
                                <button type="submit">
                                    {{ __('Crear') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
