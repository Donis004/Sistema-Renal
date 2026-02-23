<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlertaClinica extends Model
{
    use HasFactory;

    protected $table = 'alerta_clinicas';
    protected $primaryKey = 'id_alerta';

    protected $fillable = [
        'id_paciente',
        'tipo',
        'descripcion',
        'nivel',
        'atendida',
        'fecha',
    ];

    protected $casts = [
        'atendida' => 'boolean',
        'fecha' => 'datetime',
    ];

    /**
     * Get the paciente that owns the alerta.
     */
    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class, 'id_paciente', 'id_paciente');
    }
}
