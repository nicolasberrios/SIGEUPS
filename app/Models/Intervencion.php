<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Intervencion extends Model
{
    protected $table = 'intervenciones';

    protected $fillable = [
        'evento_id',
        'tipo_intervencion_id',
    ];

    /**
     * Evento al que pertenece la intervención.
     */
    public function evento(): BelongsTo
    {
        return $this->belongsTo(Evento::class);
    }

    /**
     * Tipo de intervención realizada.
     */
    public function tipoIntervencion(): BelongsTo
    {
        return $this->belongsTo(TipoIntervencion::class);
    }
}