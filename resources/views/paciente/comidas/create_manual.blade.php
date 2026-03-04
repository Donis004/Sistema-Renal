@extends('layouts.app_paciente')

@section('contenido')
<div class="mb-4">
    <a href="{{ route('paciente.comidas.index') }}" class="text-decoration-none text-muted mb-2 d-inline-block">
        <i class="bi bi-arrow-left me-1"></i> Volver a mis comidas
    </a>
    <h2 class="fw-bold text-dark">Registro Manual de Comida</h2>
    <p class="text-muted">Busca y añade todos los alimentos que conforman tu plato actual.</p>
</div>

<div class="row g-4 mb-5">
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4"><i class="bi bi-search text-primary-custom me-2"></i> Buscar Alimento</h5>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Selecciona el alimento</label>
                    <select id="select-alimento" class="form-select" style="width: 100%;">
                        <option value="">Escribe para buscar...</option>
                        @foreach($alimentos as $alimento)
                            <option value="{{ $alimento->id_alimento }}" 
                                    data-nombre="{{ $alimento->nombre }}" 
                                    data-porcion="{{ $alimento->porcion_estandar }}">
                                {{ $alimento->nombre }} (Porción: {{ $alimento->porcion_estandar }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Cantidad (en porciones)</label>
                    <div class="input-group">
                        <input type="number" id="input-cantidad" step="0.25" min="0.25" class="form-control" value="1">
                        <span class="input-group-text bg-light">porciones</span>
                    </div>
                </div>

                <button type="button" id="btn-agregar" class="btn btn-outline-primary-custom w-100 rounded-3">
                    <i class="bi bi-plus-circle me-2"></i> Añadir al plato
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4"><i class="bi bi-basket text-primary-custom me-2"></i> Mi Plato</h5>
                
                <div class="table-responsive mb-4">
                    <table class="table table-hover align-middle" id="tabla-plato">
                        <thead class="text-muted small border-bottom">
                            <tr>
                                <th>Alimento</th>
                                <th>Cantidad</th>
                                <th class="text-end">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="lista-alimentos">
                            <tr id="fila-vacia">
                                <td colspan="3" class="text-center text-muted py-4">Aún no has añadido alimentos a tu plato.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <form action="{{ route('paciente.comidas.store_manual') }}" method="POST" id="form-comida">
                    @csrf
                    <div id="inputs-ocultos"></div>
                    
                    <button type="submit" id="btn-guardar-comida" class="btn btn-primary-custom btn-lg w-100 rounded-3" disabled>
                        <i class="bi bi-check2-circle me-2"></i> Guardar Comida Completa
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* Ajustes para que Select2 se vea como Bootstrap 5 */
    .select2-container .select2-selection--single { height: 38px; border: 1px solid #dee2e6; border-radius: 0.375rem; }
    .select2-container--default .select2-selection--single .select2-selection__rendered { line-height: 38px; }
    .select2-container--default .select2-selection--single .select2-selection__arrow { height: 36px; }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#select-alimento').select2({
            placeholder: "Escribe para buscar un alimento...",
            allowClear: true
        });

        let contadorAlimentos = 0;

        $('#btn-agregar').click(function() {
            let select = $('#select-alimento');
            let optionSelected = select.find('option:selected');
            
            let idAlimento = select.val();
            let nombre = optionSelected.data('nombre');
            let porcionTexto = optionSelected.data('porcion');
            let cantidad = $('#input-cantidad').val();

            if (!idAlimento) {
                alert('Por favor selecciona un alimento primero.');
                return;
            }

            if (cantidad <= 0) {
                alert('La cantidad debe ser mayor a 0.');
                return;
            }

            $('#fila-vacia').remove();

            let filaUnicaId = 'fila-' + contadorAlimentos;
            let nuevaFila = `
                <tr id="${filaUnicaId}">
                    <td class="fw-semibold">${nombre}</td>
                    <td>${cantidad} x ${porcionTexto}</td>
                    <td class="text-end">
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="eliminarAlimento('${filaUnicaId}')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            $('#lista-alimentos').append(nuevaFila);

            let inputsOcultos = `
                <div id="inputs-${filaUnicaId}">
                    <input type="hidden" name="alimentos[]" value="${idAlimento}">
                    <input type="hidden" name="cantidades[]" value="${cantidad}">
                </div>
            `;
            $('#inputs-ocultos').append(inputsOcultos);

            select.val(null).trigger('change');
            $('#input-cantidad').val(1);
            $('#btn-guardar-comida').prop('disabled', false);
            
            contadorAlimentos++;
        });
    });

    function eliminarAlimento(idFila) {
        $('#' + idFila).remove();
        $('#inputs-' + idFila).remove();

        if ($('#inputs-ocultos').children().length === 0) {
            $('#btn-guardar-comida').prop('disabled', true);
            $('#lista-alimentos').html('<tr id="fila-vacia"><td colspan="3" class="text-center text-muted py-4">Aún no has añadido alimentos a tu plato.</td></tr>');
        }
    }
</script>
@endpush
@endsection