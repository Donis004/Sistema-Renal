<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LimitesNutricionales extends Model
{
    use HasFactory;

    protected $table = 'limites_nutricionales';
    protected $primaryKey = 'id_limite';

    protected $fillable = [
        'id_paciente',
        'potasio_mg',
        'fosforo_mg',
        'sodio_mg',
        'liquidos_ml',
        'proteina_g',
        'origen',
        'ajustado_por',
        'justificacion',
        'fecha_actualizacion',
    ];

    protected $casts = [
        'potasio_mg' => 'integer',
        'fosforo_mg' => 'integer',
        'sodio_mg' => 'integer',
        'liquidos_ml' => 'integer',
        'proteina_g' => 'decimal:2',
        'fecha_actualizacion' => 'datetime',
    ];

    /**
     * Get the paciente that owns the limites.
     */
    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class, 'id_paciente', 'id_paciente');
    }

    /**
     * Get the usuario that adjusted the limites.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'ajustado_por', 'id_usuario');
    }
}
