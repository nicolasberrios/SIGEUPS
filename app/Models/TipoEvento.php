<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoEvento extends Model
{
    protected $table = 'tipos_evento';

    protected $fillable = [
        'nombre',
        'categoria',
    ];

    /**
     * Eventos asociados a este tipo.
     */
    public function eventos(): HasMany
    {
        return $this->hasMany(Evento::class);
    }
}