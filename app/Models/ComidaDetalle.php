<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComidaDetalle extends Model
{
    use HasFactory;

    protected $table = 'comida_detalles';
    protected $primaryKey = 'id_detalle';

    protected $fillable = [
        'id_comida',
        'id_alimento',
        'cantidad_porcion',
    ];

    protected $casts = [
        'cantidad_porcion' => 'decimal:2',
    ];

    /**
     * Get the comida that owns the detalle.
     */
    public function comida(): BelongsTo
    {
        return $this->belongsTo(Comida::class, 'id_comida', 'id_comida');
    }

    /**
     * Get the alimento that owns the detalle.
     */
    public function alimento(): BelongsTo
    {
        return $this->belongsTo(Alimento::class, 'id_alimento', 'id_alimento');
    }
}
