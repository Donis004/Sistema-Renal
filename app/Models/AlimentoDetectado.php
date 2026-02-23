<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AlimentoDetectado extends Model
{
    use HasFactory;

    protected $table = 'alimento_detectados';
    protected $primaryKey = 'id_detectado';

    protected $fillable = [
        'id_analisis',
        'nombre_detectado',
        'id_alimento',
        'confianza',
        'es_peligroso',
        'motivo',
    ];

    protected $casts = [
        'confianza' => 'decimal:2',
        'es_peligroso' => 'boolean',
    ];

    /**
     * Get the analisisImagen that owns the alimentoDetectado.
     */
    public function analisisImagen(): BelongsTo
    {
        return $this->belongsTo(AnalisisImagen::class, 'id_analisis', 'id_analisis');
    }

    /**
     * Get the alimento that owns the alimentoDetectado.
     */
    public function alimento(): BelongsTo
    {
        return $this->belongsTo(Alimento::class, 'id_alimento', 'id_alimento');
    }

    /**
     * Get the advertenciaAlimentarias for this alimentoDetectado.
     */
    public function advertenciaAlimentarias(): HasMany
    {
        return $this->hasMany(AdvertenciaAlimentaria::class, 'id_detectado', 'id_detectado');
    }
}
