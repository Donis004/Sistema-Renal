<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sintoma extends Model
{
    use HasFactory;

    protected $table = 'sintomas';
    protected $primaryKey = 'id_sintoma';

    protected $fillable = [
        'nombre',
    ];

    /**
     * Get the registroSintomas for this sintoma.
     */
    public function registroSintomas(): HasMany
    {
        return $this->hasMany(RegistroSintoma::class, 'id_sintoma', 'id_sintoma');
    }
}
