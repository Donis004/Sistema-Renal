<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alimento extends Model
{
    use HasFactory;

    protected $table = 'alimentos';
    protected $primaryKey = 'id_alimento';

    protected $fillable = [
        'nombre',
        'potasio_mg',
        'fosforo_mg',
        'sodio_mg',
        'proteina_g',
        'porcion_estandar',
        'seguro_renal',
        'estado',
    ];

    protected $casts = [
        'potasio_mg' => 'integer',
        'fosforo_mg' => 'integer',
        'sodio_mg' => 'integer',
        'proteina_g' => 'decimal:2',
        'seguro_renal' => 'boolean',
        'estado' => 'boolean',
    ];

    /**
     * Get the comidaDetalles for this alimento.
     */
    public function comidaDetalles(): HasMany
    {
        return $this->hasMany(ComidaDetalle::class, 'id_alimento', 'id_alimento');
    }

    /**
     * Get the menuDetalles for this alimento.
     */
    public function menuDetalles(): HasMany
    {
        return $this->hasMany(MenuDetalle::class, 'id_alimento', 'id_alimento');
    }

    /**
     * Get the alimentoDetectados for this alimento.
     */
    public function alimentoDetectados(): HasMany
    {
        return $this->hasMany(AlimentoDetectado::class, 'id_alimento', 'id_alimento');
    }
}
