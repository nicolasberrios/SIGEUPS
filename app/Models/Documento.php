<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Documento extends Model
{
    protected $table = 'documentos';

    protected $fillable = [
        'ups_id',
        'evento_id',
        'usuario_id',
        'nombre_original',
        'ruta',
        'extension',
        'tamano',
    ];

    public function ups(): BelongsTo
    {
        return $this->belongsTo(Ups::class, 'ups_id');
    }

    public function evento(): BelongsTo
    {
        return $this->belongsTo(Evento::class);
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}