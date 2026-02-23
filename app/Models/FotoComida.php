<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FotoComida extends Model
{
    use HasFactory;

    protected $table = 'foto_comidas';
    protected $primaryKey = 'id_foto';

    protected $fillable = [
        'id_comida',
        'url_imagen',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    /**
     * Get the comida that owns the foto.
     */
    public function comida(): BelongsTo
    {
        return $this->belongsTo(Comida::class, 'id_comida', 'id_comida');
    }

    /**
     * Get the analisisImagenes for this foto.
     */
    public function analisisImagenes(): HasMany
    {
        return $this->hasMany(AnalisisImagen::class, 'id_foto', 'id_foto');
    }
}
