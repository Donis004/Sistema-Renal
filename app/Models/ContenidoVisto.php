<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContenidoVisto extends Model
{
    use HasFactory;

    protected $table = 'contenido_visto';
    protected $primaryKey = false;

    protected $fillable = [
        'id_paciente',
        'id_contenido',
        'fecha_visto',
    ];

    protected $casts = [
        'fecha_visto' => 'datetime',
    ];

    /**
     * Get the paciente that owns the contenidoVisto.
     */
    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class, 'id_paciente', 'id_paciente');
    }

    /**
     * Get the contenidoEducativo that owns the contenidoVisto.
     */
    public function contenidoEducativo(): BelongsTo
    {
        return $this->belongsTo(ContenidoEducativo::class, 'id_contenido', 'id_contenido');
    }
}
