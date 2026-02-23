<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContenidoEducativo extends Model
{
    use HasFactory;

    protected $table = 'contenidos_educativos';
    protected $primaryKey = 'id_contenido';

    protected $fillable = [
        'titulo',
        'etapa_erc',
        'tipo',
        'contenido',
    ];

    /**
     * Get the contenidosVistos for this contenido.
     */
    public function contenidosVistos(): HasMany
    {
        return $this->hasMany(ContenidoVisto::class, 'id_contenido', 'id_contenido');
    }

    /**
     * Get the pacientes that have viewed this contenido.
     */
    public function pacientes(): BelongsToMany
    {
        return $this->belongsToMany(Paciente::class, 'contenido_visto', 'id_contenido', 'id_paciente')
            ->withPivot('fecha_visto');
    }
}
