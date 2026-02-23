<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuSemanal extends Model
{
    use HasFactory;

    protected $table = 'menu_semanales';
    protected $primaryKey = 'id_menu';

    protected $fillable = [
        'id_paciente',
        'semana_inicio',
    ];

    protected $casts = [
        'semana_inicio' => 'date',
    ];

    /**
     * Get the paciente that owns the menu.
     */
    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class, 'id_paciente', 'id_paciente');
    }

    /**
     * Get the menuDetalles for this menu.
     */
    public function menuDetalles(): HasMany
    {
        return $this->hasMany(MenuDetalle::class, 'id_menu', 'id_menu');
    }
}
