@extends('layouts.app_paciente')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-0"><i class="bi bi-person-lines-fill text-primary-custom me-2"></i> Mi Perfil</h2>
        <p class="text-muted">Tus datos médicos y límites nutricionales actuales.</p>
    </div>
    <div>
        <a href="{{ route('paciente.perfil.edit') }}" class="btn btn-primary-custom shadow-sm rounded-pill px-4">
            <i class="bi bi-pencil-square me-2"></i> Actualizar Datos
        </a>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-lg-5 col-xl-4 d-flex flex-column gap-4">
        
        <div class="card border-0 shadow-sm rounded-4 text-center">
            <div class="card-body p-4">
                <div class="bg-light-green rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                    <span class="fs-1 text-primary-custom fw-bold">{{ substr($usuario->nombre, 0, 1) }}</span>
                </div>
                <h4 class="fw-bold mb-1">{{ $usuario->nombre }}</h4>
                <p class="text-muted mb-3">{{ $usuario->email }}</p>
                
                <div class="d-flex justify-content-center gap-2 mb-2">
                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2">
                        Edad: {{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age }} años
                    </span>
                    <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-3 py-2">
                        Peso: {{ $paciente->peso_kg }} kg
                    </span>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-0">
                <h6 class="fw-bold text-dark"><i class="bi bi-clipboard2-pulse text-danger me-2"></i> Estado Renal</h6>
            </div>
            <div class="card-body p-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center bg-transparent">
                        <span class="text-muted">Etapa ERC</span>
                        <span class="fw-bold text-dark fs-5">Etapa {{ $paciente->etapa_erc }}</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center bg-transparent">
                        <span class="text-muted">eGFR (Filtración)</span>
                        <span class="fw-bold text-dark">{{ $paciente->egfr }} mL/min</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center bg-transparent">
                        <span class="text-muted">Presión Arterial</span>
                        <span class="fw-bold text-dark">{{ $paciente->presion_arterial }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h6 class="fw-bold text-dark mb-3"><i class="bi bi-journal-medical text-warning me-2"></i> Antecedentes</h6>
                
                <div class="mb-3">
                    <span class="text-muted small d-block mb-1">Comorbilidades:</span>
                    @forelse($paciente->comorbilidades as $com)
                        <span class="badge bg-secondary mb-1">{{ $com->nombre }}</span>
                    @empty
                        <span class="text-muted small">Ninguna registrada</span>
                    @endforelse
                </div>
                
                <div>
                    <span class="text-muted small d-block mb-1">Alergias:</span>
                    @forelse($paciente->alergias as $alergia)
                        <span class="badge bg-danger bg-opacity-75 mb-1">{{ $alergia->nombre }}</span>
                    @empty
                        <span class="text-muted small">Ninguna registrada</span>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

    <div class="col-lg-7 col-xl-8">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-light-green border border-success border-opacity-10">
            <div class="card-body p-4 p-md-5">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h4 class="fw-bold text-dark mb-1"><i class="bi bi-shield-check text-success me-2"></i> Tus Límites Diarios</h4>
                        <p class="text-muted small">Calculados en base a tu etapa y peso actual.</p>
                    </div>
                    @if($limites)
                        <span class="badge bg-white text-muted border px-3 py-2">
                            Actualizado: {{ $limites->created_at->format('d M, Y') }}
                        </span>
                    @endif
                </div>

                @if($limites)
                    <div class="row g-4 mt-2">
                        <div class="col-md-6">
                            <div class="bg-white p-3 rounded-4 shadow-sm border border-light">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bg-success bg-opacity-10 p-2 rounded-3 me-3"><i class="bi bi-egg-fried text-success fs-4"></i></div>
                                    <span class="text-muted fw-semibold">Proteína</span>
                                </div>
                                <h3 class="fw-bold text-dark mb-0">{{ $limites->proteina_g }} <span class="fs-6 text-muted fw-normal">g / día</span></h3>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-white p-3 rounded-4 shadow-sm border border-light">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3"><i class="bi bi-moisture text-primary fs-4"></i></div>
                                    <span class="text-muted fw-semibold">Sodio</span>
                                </div>
                                <h3 class="fw-bold text-dark mb-0">{{ $limites->sodio_mg }} <span class="fs-6 text-muted fw-normal">mg / día</span></h3>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-white p-3 rounded-4 shadow-sm border border-light">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bg-warning bg-opacity-10 p-2 rounded-3 me-3"><i class="bi bi-lightning-charge text-warning fs-4"></i></div>
                                    <span class="text-muted fw-semibold">Potasio</span>
                                </div>
                                <h3 class="fw-bold text-dark mb-0">{{ $limites->potasio_mg }} <span class="fs-6 text-muted fw-normal">mg / día</span></h3>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-white p-3 rounded-4 shadow-sm border border-light">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bg-secondary bg-opacity-10 p-2 rounded-3 me-3"><i class="bi bi-record-circle text-secondary fs-4"></i></div>
                                    <span class="text-muted fw-semibold">Fósforo</span>
                                </div>
                                <h3 class="fw-bold text-dark mb-0">{{ $limites->fosforo_mg }} <span class="fs-6 text-muted fw-normal">mg / día</span></h3>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg-white p-3 rounded-4 shadow-sm border border-info border-opacity-50">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-info bg-opacity-10 p-3 rounded-3 me-3"><i class="bi bi-droplet-fill text-info fs-3"></i></div>
                                        <div>
                                            <span class="text-muted fw-semibold d-block">Líquidos Permitidos</span>
                                            <h3 class="fw-bold text-dark mb-0">{{ $limites->liquidos_ml }} <span class="fs-6 text-muted fw-normal">ml / día</span></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning border-0 shadow-sm rounded-4">
                        Aún no se han calculado tus límites nutricionales.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection