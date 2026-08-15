<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fotografia extends Model
{
    protected $table = 'fotografias';

    protected $fillable = [
        'evento_id',
        'usuario_id',
        'ruta',
        'descripcion',
    ];

    /**
     * Evento al que pertenece la fotografía.
     */
    public function evento(): BelongsTo
    {
        return $this->belongsTo(Evento::class);
    }

    /**
     * Usuario que subió la fotografía.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}