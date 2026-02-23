<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comida extends Model
{
    use HasFactory;

    protected $table = 'comidas';
    protected $primaryKey = 'id_comida';

    protected $fillable = [
        'id_paciente',
        'tipo_registro',
        'fecha_hora',
        'estado',
    ];

    protected $casts = [
        'fecha_hora' => 'datetime',
        'estado' => 'boolean',
    ];

    /**
     * Get the paciente that owns the comida.
     */
    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class, 'id_paciente', 'id_paciente');
    }

    /**
     * Get the comidaDetalles for this comida.
     */
    public function comidaDetalles(): HasMany
    {
        return $this->hasMany(ComidaDetalle::class, 'id_comida', 'id_comida');
    }

    /**
     * Get the fotoComidas for this comida.
     */
    public function fotoComidas(): HasMany
    {
        return $this->hasMany(FotoComida::class, 'id_comida', 'id_comida');
    }
}
