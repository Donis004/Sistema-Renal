<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConsumoLiquidos extends Model
{
    use HasFactory;

    protected $table = 'consumo_liquidos';
    protected $primaryKey = 'id_consumo';

    protected $fillable = [
        'id_paciente',
        'cantidad_ml',
        'descripcion',
        'fecha_hora',
    ];

    protected $casts = [
        'cantidad_ml' => 'integer',
        'fecha_hora' => 'datetime',
    ];

    /**
     * Get the paciente that owns the consumo.
     */
    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class, 'id_paciente', 'id_paciente');
    }
}
