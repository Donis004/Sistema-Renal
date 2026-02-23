<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recomendacion extends Model
{
    use HasFactory;

    protected $table = 'recomendaciones';
    protected $primaryKey = 'id_recomendacion';

    protected $fillable = [
        'id_paciente',
        'id_profesional',
        'mensaje',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    /**
     * Get the paciente that owns the recomendacion.
     */
    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class, 'id_paciente', 'id_paciente');
    }

    /**
     * Get the profesional that owns the recomendacion.
     */
    public function profesional(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_profesional', 'id_usuario');
    }
}
