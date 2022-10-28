@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Crear ficha</h1>
        </div>

        <div class="d-flex align-self-center justify-content-center pt-3">
        @include('layouts.alerts')
        </div>

        <div class="form-card-container">
            <div class="form-card">
                <div class="form-card-header">
                    <h1>Datos del Paciente</h1>
                </div>

                <div class="form-card-body">
                    <form class="form-card" action="{{ route('record.next') }}" method="POST">
                        @csrf

                        <div class="row pb-3">

                            <div class="col-5">
                                <div class="form-item">
                                    <label class="form-label" for="rut">RUT</label>
                                    <input type="text" @error('rut') class="form-control is-invalid" @enderror name="rut" value="{{ old('rut') }}" data-inputmask="'alias': 'rut'" required>
                                    @error('rut')
                                    <span class="text-danger">Ingrese un rut válido</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-7">
                                <div class="form-item">
                                    <label class="form-label" for="name">Nombre</label>
                                    <input type="text" @error('name') class="form-control is-invalid" @enderror name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                    <span class="text-danger">Ingrese un nombre válido</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row pb-3">

                            <div class="col-6">
                                <div class="form-item">
                                    <label class="form-label" for="paternal_name">Apellido Paterno</label>
                                    <input type="text" @error('paternal_name') class="form-control is-invalid" @enderror name="paternal_name" value="{{ old('paternal_name') }}" required>
                                    @error('paternal_name')
                                    <span class="text-danger">Ingrese un apellido válido</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-item">
                                    <label class="form-label" for="maternal_name">Apellido Materno</label>
                                    <input type="text" @error('maternal_name') class="form-control is-invalid" @enderror name="maternal_name" value="{{ old('maternal_name') }}" required>
                                    @error('maternal_name')
                                    <span class="text-danger">Ingrese un apellido válido</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row pb-3">

                            <div class="col-6">
                                <div class="form-item">
                                    <label class="form-label" for="birth_date">Fecha de Nacimiento</label>
                                    <input type="date" @error('birth_date') class="form-control is-invalid" @enderror name="birth_date" value="{{ old('birth_date') }}" required>
                                    @error('birth_date')
                                    <span class="text-danger">Ingrese una fecha válida</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-item">
                                    <label class="form-label" for="gender">Género del Paciente</label>
                                    <select class="form-select" name="gender">
                                        <option value="">Elija una opción</option>
                                        <option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>Masculino</option>
                                        <option value="2" {{ old('gender') == 2 ? 'selected' : '' }}>Femenino</option>
                                        <option value="3" {{ old('gender') == 3 ? 'selected' : '' }}>No binario</option>
                                        <option value="4" {{ old('gender') == 4 ? 'selected' : '' }}>Otro</option>
                                    </select>
                                    @error('gender')
                                    <span class="text-danger">Ingrese un género</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row pb-3">

                            <div class="col-8">
                                <div class="form-item">
                                    <label class="form-label" for="address">Dirección Particular</label>
                                    <input type="text" @error('address') class="form-control is-invalid" @enderror name="address" value="{{ old('address') }}" required>
                                    @error('address')
                                    <span class="text-danger">Ingrese una dirección válida</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-item">
                                    <label class="form-label" for="city">Ciudad</label>
                                    <input type="text" @error('city') class="form-control is-invalid" @enderror name="city" value="{{ old('city') }}" required>
                                    @error('city')
                                    <span class="text-danger">Ingrese una ciudad válida</span>
                                    @enderror
                                </div>
                            </div>
                        
                        </div>
                        <div class="row pb-3">

                            <div class="col-6">
                                <div class="form-item">
                                    <label class="form-label" for="email">Correo Electrónico</label>
                                    <input type="email" @error('email') class="form-control is-invalid" @enderror name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <span class="text-danger">Ingrese un correo válido</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-item">
                                    <label class="form-label" for="occupation">Ocupación o Cargo Profesional</label>
                                    <input type="text" @error('occupation') class="form-control is-invalid" @enderror name="occupation" value="{{ old('occupation') }}" required>
                                    @error('occupation')
                                    <span class="text-danger">Ingrese una ocupación válida</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <button type="submit">
                            {{ __('Siguiente') }}
                        </button>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- * * Live Formater RUT * * ---}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/css/inputmask.min.css" rel="stylesheet"/>

<script>
Inputmask.extendAliases({
    rut: {
        mask: '(9(.999){2}-K)|(99(.999){2}-K)',
        autoUnmask: true, //para que .val() devuelva sin mascara (sin puntos ni guion)
        keepStatic: true, //para que el formato de mascara mas corta se mantenga hasta que sea necesario el mas largo
        showMaskOnFocus: false, //oculta la mascara en focus
        showMaskOnHover: false, //oculta la mascara en hover
        definitions: {
            'K': {
                validator: '[0-9|kK]',
                casing: 'upper',
            }
        }
    }
});
$('input').inputmask();
</script>

{{-- * * * * *---}}
@endsection
