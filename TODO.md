# Plan: Modelos y Migraciones para Sistema Renal

## Análisis del Proyecto
- **Framework**: Laravel 11+
- **Base de datos**: MySQL (tabla `usuarios` ya existe en migraciones)
- **Sistema**: Control de pacientes con insuficiencia renal

## Información Recopilada
1. **Migration existente**: `usuarios` (ya creada con id_usuario, nombre, email, password_hash, rol, estado, fecha_registro)
2. **User Model**: Actualizado a Usuario.php

## Estado de Implementación ✅

### Modelos creados/actualizados (27 modelos):
- [x] **Usuario** (actualizado User.php -> Usuario.php)
- [x] **Paciente**
- [x] **Alergia**
- [x] **PacienteAlergia** (pivot - en Paciente.php con BelongsToMany)
- [x] **Comorbilidad**
- [x] **PacienteComorbilidad** (pivot - en Paciente.php con BelongsToMany)
- [x] **LimitesNutricionales**
- [x] **Alimento**
- [x] **Comida**
- [x] **ComidaDetalle**
- [x] **FotoComida**
- [x] **AnalisisImagen**
- [x] **AlimentoDetectado**
- [x] **AdvertenciaAlimentaria**
- [x] **ConsumoLiquidos**
- [x] **Medicamento**
- [x] **PacienteMedicamento**
- [x] **RecordatorioMedicamento**
- [x] **Sintoma**
- [x] **RegistroSintoma**
- [x] **AlertaClinica**
- [x] **ContenidoEducativo**
- [x] **ContenidoVisto** (pivot - en Paciente.php con BelongsToMany)
- [x] **Recomendacion**
- [x] **MenuSemanal**
- [x] **MenuDetalle**
- [x] **LogCambios**

### Migraciones creadas (26 migraciones):
- [x] 2024_01_02_000001_create_alergias_table
- [x] 2024_01_02_000002_create_comorbilidades_table
- [x] 2024_01_02_000003_create_medicamentos_table
- [x] 2024_01_02_000004_create_sintomas_table
- [x] 2024_01_02_000005_create_contenidos_educativos_table
- [x] 2024_01_02_000006_create_alimentos_table
- [x] 2024_01_02_000007_create_pacientes_table
- [x] 2024_01_02_000008_create_paciente_alergia_table
- [x] 2024_01_02_000009_create_paciente_comorbilidad_table
- [x] 2024_01_02_000010_create_limites_nutricionales_table
- [x] 2024_01_02_000011_create_comidas_table
- [x] 2024_01_02_000012_create_comida_detalles_table
- [x] 2024_01_02_000013_create_foto_comidas_table
- [x] 2024_01_02_000014_create_analisis_imagenes_table
- [x] 2024_01_02_000015_create_alimento_detectados_table
- [x] 2024_01_02_000016_create_advertencia_alimentarias_table
- [x] 2024_01_02_000017_create_consumo_liquidos_table
- [x] 2024_01_02_000018_create_paciente_medicamentos_table
- [x] 2024_01_02_000019_create_recordatorio_medicamentos_table
- [x] 2024_01_02_000020_create_registro_sintomas_table
- [x] 2024_01_02_000021_create_alerta_clinicas_table
- [x] 2024_01_02_000022_create_contenido_visto_table
- [x] 2024_01_02_000023_create_recomendaciones_table
- [x] 2024_01_02_000024_create_menu_semanales_table
- [x] 2024_01_02_000025_create_menu_detalles_table
- [x] 2024_01_02_000026_create_log_cambios_table

## Configuración adicional:
- [x] Actualizado config/auth.php para usar App\Models\Usuario
- [x] Renombrado User.php a Usuario.php

## Próximos pasos para ejecutar:
1. Configurar la conexión a la base de datos en .env
2. Ejecutar `php artisan migrate` para crear las tablas
3. Opcional: Ejecutar `php artisan make:seeder` para crear seeders de datos iniciales
