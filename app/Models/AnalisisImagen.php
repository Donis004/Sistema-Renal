<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnalisisImagen extends Model
{
    use HasFactory;

    protected $table = 'analisis_imagenes';
    protected $primaryKey = 'id_analisis';

    protected $fillable = [
        'id_foto',
        'estado',
        'nivel_riesgo',
        'observacion_general',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    /**
     * Get the fotoComida that owns the analisis.
     */
    public function fotoComida(): BelongsTo
    {
        return $this->belongsTo(FotoComida::class, 'id_foto', 'id_foto');
    }

    /**
     * Get the alimentoDetectados for this analisis.
     */
    public function alimentoDetectados(): HasMany
    {
        return $this->hasMany(AlimentoDetectado::class, 'id_analisis', 'id_analisis');
    }
}
