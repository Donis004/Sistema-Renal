<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';
    protected $primaryKey = 'id_paciente';

    protected $fillable = [
        'id_usuario',
        'fecha_nacimiento',
        'sexo',
        'peso_kg',
        'presion_arterial',
        'etapa_erc',
        'egfr',
        'dieta_prescrita',
        'perfil_completo',
        'estado',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'peso_kg' => 'decimal:2',
        'egfr' => 'decimal:2',
        'perfil_completo' => 'boolean',
        'estado' => 'boolean',
    ];

    /**
     * Get the usuario that owns the paciente.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    /**
     * Get the alergias for the paciente.
     */
    public function alergias(): BelongsToMany
    {
        return $this->belongsToMany(Alergia::class, 'paciente_alergia', 'id_paciente', 'id_alergia');
    }

    /**
     * Get the comorbilidades for the paciente.
     */
    public function comorbilidades(): BelongsToMany
    {
        return $this->belongsToMany(Comorbilidad::class, 'paciente_comorbilidad', 'id_paciente', 'id_comorbilidad');
    }

    /**
     * Get the limitesNutricionales for the paciente.
     */
    public function limitesNutricionales(): HasMany
    {
        return $this->hasMany(LimitesNutricionales::class, 'id_paciente', 'id_paciente');
    }

    /**
     * Get the comidas for the paciente.
     */
    public function comidas(): HasMany
    {
        return $this->hasMany(Comida::class, 'id_paciente', 'id_paciente');
    }

    /**
     * Get the consumoLiquidos for the paciente.
     */
    public function consumoLiquidos(): HasMany
    {
        return $this->hasMany(ConsumoLiquidos::class, 'id_paciente', 'id_paciente');
    }

    /**
     * Get the pacienteMedicamentos for the paciente.
     */
    public function pacienteMedicamentos(): HasMany
    {
        return $this->hasMany(PacienteMedicamento::class, 'id_paciente', 'id_paciente');
    }

    /**
     * Get the registroSintomas for the paciente.
     */
    public function registroSintomas(): HasMany
    {
        return $this->hasMany(RegistroSintoma::class, 'id_paciente', 'id_paciente');
    }

    /**
     * Get the alertaClinicas for the paciente.
     */
    public function alertaClinicas(): HasMany
    {
        return $this->hasMany(AlertaClinica::class, 'id_paciente', 'id_paciente');
    }

    /**
     * Get the contenidosVistos for the paciente.
     */
    public function contenidosVistos(): BelongsToMany
    {
        return $this->belongsToMany(ContenidoEducativo::class, 'contenido_visto', 'id_paciente', 'id_contenido')
            ->withPivot('fecha_visto');
    }

    /**
     * Get the recomendaciones for the paciente.
     */
    public function recomendaciones(): HasMany
    {
        return $this->hasMany(Recomendacion::class, 'id_paciente', 'id_paciente');
    }

    /**
     * Get the menuSemanales for the paciente.
     */
    public function menuSemanales(): HasMany
    {
        return $this->hasMany(MenuSemanal::class, 'id_paciente', 'id_paciente');
    }
}
