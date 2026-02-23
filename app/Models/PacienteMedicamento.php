<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PacienteMedicamento extends Model
{
    use HasFactory;

    protected $table = 'paciente_medicamentos';
    protected $primaryKey = 'id_pm';

    protected $fillable = [
        'id_paciente',
        'id_medicamento',
        'dosis',
        'frecuencia',
        'con_alimentos',
        'activo',
    ];

    protected $casts = [
        'con_alimentos' => 'boolean',
        'activo' => 'boolean',
    ];

    /**
     * Get the paciente that owns the pacienteMedicamento.
     */
    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class, 'id_paciente', 'id_paciente');
    }

    /**
     * Get the medicamento that owns the pacienteMedicamento.
     */
    public function medicamento(): BelongsTo
    {
        return $this->belongsTo(Medicamento::class, 'id_medicamento', 'id_medicamento');
    }

    /**
     * Get the recordatorioMedicamentos for this pacienteMedicamento.
     */
    public function recordatorioMedicamentos(): HasMany
    {
        return $this->hasMany(RecordatorioMedicamento::class, 'id_pm', 'id_pm');
    }
}
