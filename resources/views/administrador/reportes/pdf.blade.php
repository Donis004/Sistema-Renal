<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte Clínico</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      color: #333;
      line-height: 1.6;
    }

    .container {
      max-width: 900px;
      margin: 0 auto;
      padding: 20px;
    }

    /* ENCABEZADO */
    .header {
      background: linear-gradient(135deg, #1fbf83, #38b2ac);
      color: white;
      padding: 30px;
      border-radius: 8px;
      margin-bottom: 30px;
      text-align: center;
    }

    .header h1 {
      font-size: 28px;
      margin-bottom: 10px;
    }

    .header p {
      opacity: 0.9;
      font-size: 14px;
    }

    /* TABLA DE INFORMACIÓN DEL PACIENTE */
    .info-paciente {
      background: #f9fafb;
      padding: 20px;
      border-radius: 8px;
      margin-bottom: 30px;
      border-left: 4px solid #1fbf83;
    }

    .info-paciente h3 {
      color: #1fbf83;
      margin-bottom: 15px;
      font-size: 16px;
    }

    .info-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 15px;
    }

    .info-item {
      padding: 10px 0;
    }

    .info-item .label {
      font-weight: bold;
      color: #1f2937;
      font-size: 13px;
    }

    .info-item .value {
      color: #6b7280;
      font-size: 14px;
    }

    /* SECCIONES */
    .section {
      margin-bottom: 35px;
      page-break-inside: avoid;
    }

    .section h2 {
      background: #e5f2ed;
      color: #1fbf83;
      padding: 12px 15px;
      border-radius: 6px;
      font-size: 16px;
      margin-bottom: 15px;
      border-left: 4px solid #1fbf83;
    }

    .section-content {
      background: white;
      padding: 15px;
      border: 1px solid #e5e7eb;
      border-radius: 6px;
    }

    /* TABLAS */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 15px;
    }

    thead {
      background: #f3f4f6;
    }

    th {
      padding: 12px;
      text-align: left;
      font-weight: bold;
      color: #1f2937;
      font-size: 13px;
      border-bottom: 2px solid #d1d5db;
    }

    td {
      padding: 10px 12px;
      border-bottom: 1px solid #e5e7eb;
      font-size: 13px;
    }

    tr:last-child td {
      border-bottom: none;
    }

    /* ESTADO VACÍO */
    .empty-state {
      text-align: center;
      padding: 20px;
      color: #9ca3af;
      font-size: 14px;
      background: #f9fafb;
      border-radius: 6px;
    }

    /* FOOTER */
    .footer {
      border-top: 2px solid #e5e7eb;
      padding-top: 20px;
      margin-top: 30px;
      text-align: center;
      font-size: 11px;
      color: #9ca3af;
    }

    .confidential {
      background: #fef2f2;
      color: #991b1b;
      padding: 12px;
      border-radius: 6px;
      margin-bottom: 20px;
      text-align: center;
      font-weight: bold;
      font-size: 12px;
      border: 1px solid #fee2e2;
    }

    /* BADGES */
    .badge {
      display: inline-block;
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 12px;
      font-weight: bold;
    }

    .badge-dieta {
      background: #dbeafe;
      color: #1e40af;
    }

    .badge-liquidos {
      background: #cffafe;
      color: #164e63;
    }

    .badge-sintomas {
      background: #fecaca;
      color: #7f1d1d;
    }

    /* PÁGINA BREAK */
    @page {
      size: A4;
      margin: 1cm;
    }

    @media print {
      body {
        margin: 0;
        padding: 0;
      }
      
      .section {
        page-break-inside: avoid;
      }
    }
  </style>
</head>
<body>

<div class="container">

  <!-- ENCABEZADO -->
  <div class="header">
    <h1>📋 Reporte Clínico del Paciente</h1>
    <p>Sistema de Gestión Renal - RenalMe</p>
  </div>

  <!-- CONFIDENCIALIDAD -->
  <div class="confidential">
    🔒 INFORMACIÓN CONFIDENCIAL - Solo para profesionales autorizados
  </div>

  <!-- INFORMACIÓN DEL PACIENTE -->
  <div class="info-paciente">
    <h3>👤 Datos del Paciente</h3>
    <div class="info-grid">
      <div class="info-item">
        <div class="label">Nombre del Paciente</div>
        <div class="value">{{ $paciente->usuario->nombre }}</div>
      </div>
      <div class="info-item">
        <div class="label">Email</div>
        <div class="value">{{ $paciente->usuario->email }}</div>
      </div>
      <div class="info-item">
        <div class="label">Etapa ERC</div>
        <div class="value">{{ $paciente->etapa_erc ?? 'No especificada' }}</div>
      </div>
      <div class="info-item">
        <div class="label">Período del Reporte</div>
        <div class="value">{{ $fechaInicio }} - {{ $fechaFin }}</div>
      </div>
    </div>
  </div>

  <!-- DIETA / COMIDAS -->
  <div class="section">
    <h2>🍽️ Dieta Registrada</h2>
    <div class="section-content">
      @if($comidas->count() > 0)
        <table>
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Alimentos</th>
              <th>Detalles</th>
            </tr>
          </thead>
          <tbody>
            @foreach($comidas as $comida)
              <tr>
                <td>{{ $comida->fecha_hora->format('d/m/Y H:i') }}</td>
                <td>
                  @if($comida->comidaDetalles->count() > 0)
                    @foreach($comida->comidaDetalles as $detalle)
                      <span class="badge badge-dieta">{{ $detalle->alimento->nombre }}</span>
                    @endforeach
                  @else
                    <em>Sin detalles</em>
                  @endif
                </td>
                <td>
                  @if($comida->comentarios)
                    {{ $comida->comentarios }}
                  @else
                    -
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <div class="empty-state">
          📭 No hay comidas registradas en este período
        </div>
      @endif
    </div>
  </div>

  <!-- CONSUMO DE LÍQUIDOS -->
  <div class="section">
    <h2>💧 Consumo de Líquidos</h2>
    <div class="section-content">
      @if($liquidos->count() > 0)
        <table>
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Cantidad (ml)</th>
              <th>Observaciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($liquidos as $liquido)
              <tr>
                <td>{{ $liquido->fecha->format('d/m/Y') }}</td>
                <td><strong>{{ $liquido->cantidad }} ml</strong></td>
                <td>
                  @if($liquido->observaciones)
                    {{ $liquido->observaciones }}
                  @else
                    -
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <div class="empty-state">
          📭 No hay registros de consumo de líquidos en este período
        </div>
      @endif
    </div>
  </div>

  <!-- SÍNTOMAS -->
  <div class="section">
    <h2>❤️ Síntomas Reportados</h2>
    <div class="section-content">
      @if($sintomas->count() > 0)
        <table>
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Síntoma</th>
              <th>Severidad</th>
              <th>Observaciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($sintomas as $sintoma)
              <tr>
                <td>{{ $sintoma->fecha_registro->format('d/m/Y H:i') }}</td>
                <td>
                  <span class="badge badge-sintomas">{{ $sintoma->sintoma->nombre }}</span>
                </td>
                <td>
                  @if($sintoma->severidad)
                    <strong>{{ ucfirst($sintoma->severidad) }}</strong>
                  @else
                    -
                  @endif
                </td>
                <td>
                  @if($sintoma->observaciones)
                    {{ $sintoma->observaciones }}
                  @else
                    -
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <div class="empty-state">
          📭 No hay síntomas registrados en este período
        </div>
      @endif
    </div>
  </div>

  <!-- MEDICAMENTOS -->
  <div class="section">
    <h2>💊 Medicamentos Prescritos</h2>
    <div class="section-content">
      @if($medicamentos->count() > 0)
        <table>
          <thead>
            <tr>
              <th>Medicamento</th>
              <th>Dosis</th>
              <th>Frecuencia</th>
              <th>Forma</th>
            </tr>
          </thead>
          <tbody>
            @foreach($medicamentos as $med)
              <tr>
                <td><strong>{{ $med->medicamento->nombre }}</strong></td>
                <td>{{ $med->dosis ?? '-' }}</td>
                <td>{{ $med->frecuencia ?? '-' }}</td>
                <td>{{ $med->medicamento->forma ?? '-' }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <div class="empty-state">
          📭 No hay medicamentos prescritos registrados
        </div>
      @endif
    </div>
  </div>

  <!-- FOOTER -->
  <div class="footer">
    <p><strong>Reporte generado:</strong> {{ $fechaReporte }}</p>
    <p>Sistema RenalMe © 2024 - Documento Confidencial</p>
  </div>

</div>

</body>
</html>
