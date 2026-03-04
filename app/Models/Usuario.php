<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'email',
        'password_hash',
        'rol',
        'estado',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'estado' => 'boolean',
        'fecha_registro' => 'datetime',
    ];

    /**
     * Get the pacientes for the user.
     */
    public function pacientes()
    {
        return $this->hasMany(Paciente::class, 'id_usuario', 'id_usuario');
    }

    /**
     * Get the recomendaciones made by this user.
     */
    public function recomendaciones()
    {
        return $this->hasMany(Recomendacion::class, 'id_profesional', 'id_usuario');
    }

    /**
     * Get the limites nutricionales ajustados por este usuario.
     */
    public function limitesNutricionales()
    {
        return $this->hasMany(LimitesNutricionales::class, 'ajustado_por', 'id_usuario');
    }

    /**
     * Get the logs de cambios realizados by this user.
     */
    public function logCambios()
    {
        return $this->hasMany(LogCambios::class, 'realizado_por', 'id_usuario');
    }

    /**
     * Check if user is admin.
     */
    public function isAdmin(): bool
    {
        return $this->rol === 'ADMIN';
    }

    /**
     * Check if user is doctor.
     */
    public function isDoctor(): bool
    {
        return $this->rol === 'DOCTOR';
    }

    /**
     * Check if user is nutritionist.
     */
    public function isNutricionista(): bool
    {
        return $this->rol === 'NUTRICIONISTA';
    }

    /**
     * Check if user is patient.
     */
    public function isPaciente(): bool
    {
        return $this->rol === 'PACIENTE';
    }

    /**
     * Override the default password field for Laravel Auth.
     */
    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}
