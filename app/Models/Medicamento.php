<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medicamento extends Model
{
    use HasFactory;

    protected $table = 'medicamentos';
    protected $primaryKey = 'id_medicamento';

    protected $fillable = [
        'nombre',
    ];

    /**
     * Get the pacienteMedicamentos for this medicamento.
     */
    public function pacienteMedicamentos(): HasMany
    {
        return $this->hasMany(PacienteMedicamento::class, 'id_medicamento', 'id_medicamento');
    }
}
