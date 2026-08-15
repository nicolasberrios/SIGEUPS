<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Evento extends Model
{
    protected $table = 'eventos';

    protected $fillable = [
        'ups_id',
        'tipo_evento_id',
        'usuario_id',
        'estado_resultante_id',
        'ubicacion_resultante_id',
        'fecha_hora',
        'comentario',
    ];

    /**
     * UPS a la que pertenece el evento.
     */
    public function ups(): BelongsTo
    {
        return $this->belongsTo(Ups::class);
    }

    /**
     * Tipo de evento.
     */
    public function tipoEvento(): BelongsTo
    {
        return $this->belongsTo(TipoEvento::class);
    }

    /**
     * Usuario que realizó el evento.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Estado resultante del evento.
     */
    public function estadoResultante(): BelongsTo
    {
        return $this->belongsTo(Estado::class, 'estado_resultante_id');
    }

    /**
     * Ubicación resultante del evento.
     */
    public function ubicacionResultante(): BelongsTo
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_resultante_id');
    }

    /**
     * Documentos asociados al evento.
     */
    public function documentos(): HasMany
    {
        return $this->hasMany(Documento::class);
    }

    /**
     * Fotografías asociadas al evento.
     */
    public function fotografias(): HasMany
    {
        return $this->hasMany(Fotografia::class);
    }

    /**
     * Intervenciones realizadas durante el evento.
     */
    public function intervenciones(): HasMany
    {
        return $this->hasMany(Intervencion::class);
    }
}