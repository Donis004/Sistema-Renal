<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogCambios extends Model
{
    use HasFactory;

    protected $table = 'log_cambios';
    protected $primaryKey = 'id_log';

    protected $fillable = [
        'tabla_afectada',
        'id_registro',
        'accion',
        'realizado_por',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    /**
     * Get the usuario that performed the action.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'realizado_por', 'id_usuario');
    }
}
