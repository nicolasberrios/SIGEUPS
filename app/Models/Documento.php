<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Documento extends Model
{
    protected $table = 'documentos';

    protected $fillable = [
        'evento_id',
        'usuario_id',
        'nombre_original',
        'ruta',
        'extension',
        'tamano',
    ];

    /**
     * Evento al que pertenece el documento.
     */
    public function evento(): BelongsTo
    {
        return $this->belongsTo(Evento::class);
    }

    /**
     * Usuario que subió el documento.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}