<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Comorbilidad extends Model
{
    use HasFactory;

    protected $table = 'comorbilidades';
    protected $primaryKey = 'id_comorbilidad';

    protected $fillable = [
        'nombre',
    ];

    /**
     * Get the pacientes with this comorbilidad.
     */
    public function pacientes(): BelongsToMany
    {
        return $this->belongsToMany(Paciente::class, 'paciente_comorbilidad', 'id_comorbilidad', 'id_paciente');
    }
}
