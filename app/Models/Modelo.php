<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Modelo extends Model
{
    protected $table = 'modelos';

    protected $fillable = [
        'marca_id',
        'nombre',
    ];

    /**
     * Marca a la que pertenece el modelo.
     */
    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class);
    }

    /**
     * UPS que utilizan este modelo.
     */
    public function ups(): HasMany
    {
        return $this->hasMany(Ups::class);
    }
}