<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ups extends Model
{
    protected $table = 'ups';

    protected $fillable = [
        'modelo_id',
        'propietario_id',
        'estado_actual_id',
        'ubicacion_actual_id',
        'numero_identificador',
        'numero_serie',
        'potencia_kva',
        'foto_principal',
        'observaciones',
    ];

    public function modelo(): BelongsTo
    {
        return $this->belongsTo(Modelo::class);
    }

    public function propietario(): BelongsTo
    {
        return $this->belongsTo(Propietario::class);
    }

    public function estadoActual(): BelongsTo
    {
        return $this->belongsTo(Estado::class, 'estado_actual_id');
    }

    public function ubicacionActual(): BelongsTo
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_actual_id');
    }

    public function eventos(): HasMany
    {
        return $this->hasMany(Evento::class);
    }

    public function fotografias(): HasMany
    {
        return $this->hasMany(Fotografia::class, 'ups_id');
    }
}