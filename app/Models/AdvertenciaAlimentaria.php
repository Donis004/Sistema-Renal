<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdvertenciaAlimentaria extends Model
{
    use HasFactory;

    protected $table = 'advertencia_alimentarias';
    protected $primaryKey = 'id_advertencia';

    protected $fillable = [
        'id_detectado',
        'mensaje',
        'severidad',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    /**
     * Get the alimentoDetectado that owns the advertencia.
     */
    public function alimentoDetectado(): BelongsTo
    {
        return $this->belongsTo(AlimentoDetectado::class, 'id_detectado', 'id_detectado');
    }
}
