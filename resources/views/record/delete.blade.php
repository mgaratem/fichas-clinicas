<div class="modal fade" id="delete-record" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">¡Atención! ✋🏼</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que quieres borrar la ficha?</p>
                <p class="text-danger">Esta acción borrará de forma permanente la ficha clínica 
                    junto con todas sus consultas y no se puede revertir.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a type="button" class="btn btn-danger text-white" href="#"
                    onclick="event.preventDefault(); document.getElementById('delete-record-form').submit();">
                    Borrar 💀
                </a>
                <form id="delete-record-form" action="{{ route('record.delete', ['uuid' => $record->uuid]) }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>