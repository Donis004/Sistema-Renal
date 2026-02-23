<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecordatorioMedicamento extends Model
{
    use HasFactory;

    protected $table = 'recordatorio_medicamentos';
    protected $primaryKey = 'id_recordatorio';

    protected $fillable = [
        'id_pm',
        'hora',
        'tomado',
        'fecha',
    ];

    protected $casts = [
        'hora' => 'datetime',
        'tomado' => 'boolean',
        'fecha' => 'date',
    ];

    /**
     * Get the pacienteMedicamento that owns the recordatorio.
     */
    public function pacienteMedicamento(): BelongsTo
    {
        return $this->belongsTo(PacienteMedicamento::class, 'id_pm', 'id_pm');
    }
}
