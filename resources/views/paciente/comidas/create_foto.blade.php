@extends('layouts.app_paciente')

@section('contenido')
<div class="mb-4 text-center mt-3">
    <a href="{{ route('paciente.comidas.index') }}" class="text-decoration-none text-muted mb-2 d-inline-block float-start">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
    <div class="clearfix"></div>
    <h2 class="fw-bold text-dark mt-3">Análisis Inteligente</h2>
    <p class="text-muted">Toma una foto de tu plato y nuestra IA detectará los nutrientes por ti.</p>
</div>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 text-center p-4">
            <form action="{{ route('paciente.comidas.procesar_foto') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-4">
                    <label for="foto_comida" class="d-block border border-2 border-dashed border-success rounded-4 p-5 bg-light-green" style="cursor: pointer; transition: all 0.3s;">
                        <i class="bi bi-camera text-primary-custom d-block mb-3" style="font-size: 4rem;"></i>
                        <h5 class="fw-bold text-dark">Tocar para abrir cámara</h5>
                        <p class="text-muted small mb-0">Sube una imagen clara y bien iluminada de tu plato.</p>
                    </label>
                    <input type="file" id="foto_comida" name="foto_comida" class="d-none" accept="image/*" capture="environment" required onchange="document.getElementById('btn-analizar').classList.remove('disabled')">
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" id="btn-analizar" class="btn btn-primary-custom btn-lg rounded-3 py-3 disabled">
                        <i class="bi bi-magic me-2"></i> Analizar con IA
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection