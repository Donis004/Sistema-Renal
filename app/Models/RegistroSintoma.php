<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegistroSintoma extends Model
{
    use HasFactory;

    protected $table = 'registro_sintomas';
    protected $primaryKey = 'id_registro';

    protected $fillable = [
        'id_paciente',
        'id_sintoma',
        'intensidad',
        'fecha_hora',
    ];

    protected $casts = [
        'fecha_hora' => 'datetime',
    ];

    /**
     * Get the paciente that owns the registro.
     */
    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class, 'id_paciente', 'id_paciente');
    }

    /**
     * Get the sintoma that owns the registro.
     */
    public function sintoma(): BelongsTo
    {
        return $this->belongsTo(Sintoma::class, 'id_sintoma', 'id_sintoma');
    }
}
