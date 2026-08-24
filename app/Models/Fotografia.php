<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fotografia extends Model
{
    protected $table = 'fotografias';

    protected $fillable = [
        'ups_id',
        'evento_id',
        'usuario_id',
        'ruta',
        'descripcion',
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