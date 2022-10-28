<div class="modal fade" id="create-appointment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nueva consulta 🤓</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Ingrese datos a continuación:</p>
                <form id="create-appointment-form" class="modal-form" action="{{ route('appointment.store') }}" method="POST">
                    @csrf
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 ms-auto">
                                <p>Evolución:</p>
                                <textarea name="evolution" placeholder="" rows="3">{{ old('evolution') }}</textarea>
                                @error('evolution')
                                <span class="text-danger">Ingrese información válida</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 ms-auto mt-2">
                                <p>Fecha de Consulta:</p>
                                <input type="date" name="consultation_date" value="{{ old('consultation_date') }}" required>
                                @error('consultation_date')
                                <span class="text-danger">Ingrese una fecha válida</span>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="record_uuid" value="{{ $record->uuid }}" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" href="#"
                    onclick="document.getElementById('create-appointment-form').submit();">
                    Crear <i class="fa-solid fa-check"></i>
                </button>
            </div>
        </div>
    </div>
</div>