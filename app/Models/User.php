<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'role_id',
    'name',
    'email',
    'password',
    'activo',
])]

#[Hidden([
    'password',
    'remember_token',
])]

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'activo' => 'boolean',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function eventos(): HasMany
    {
        return $this->hasMany(Evento::class, 'usuario_id');
    }

    public function intervenciones(): HasMany
    {
        return $this->hasMany(Intervencion::class, 'usuario_id');
    }

    public function isAdmin(): bool
    {
        return strtolower($this->role?->nombre ?? '') === 'administrador';
    }

    public function isUsuario(): bool
    {
        return strtolower($this->role?->nombre ?? '') === 'usuario';
    }

    public function estaActivo(): bool
    {
        return (bool) $this->activo;
    }
}