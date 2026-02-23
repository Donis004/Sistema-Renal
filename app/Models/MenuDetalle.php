<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuDetalle extends Model
{
    use HasFactory;

    protected $table = 'menu_detalles';
    protected $primaryKey = 'id_detalle';

    protected $fillable = [
        'id_menu',
        'dia',
        'tiempo_comida',
        'id_alimento',
    ];

    /**
     * Get the menuSemanal that owns the detalle.
     */
    public function menuSemanal(): BelongsTo
    {
        return $this->belongsTo(MenuSemanal::class, 'id_menu', 'id_menu');
    }

    /**
     * Get the alimento that owns the detalle.
     */
    public function alimento(): BelongsTo
    {
        return $this->belongsTo(Alimento::class, 'id_alimento', 'id_alimento');
    }
}
