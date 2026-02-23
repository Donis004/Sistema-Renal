<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Alergia extends Model
{
    use HasFactory;

    protected $table = 'alergias';
    protected $primaryKey = 'id_alergia';

    protected $fillable = [
        'nombre',
    ];

    /**
     * Get the pacientes with this alergia.
     */
    public function pacientes(): BelongsToMany
    {
        return $this->belongsToMany(Paciente::class, 'paciente_alergia', 'id_alergia', 'id_paciente');
    }
}
