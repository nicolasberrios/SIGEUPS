<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ubicacion extends Model
{
    protected $table = 'ubicaciones';

    protected $fillable = [
        'nombre',
    ];

    /**
     * UPS que actualmente se encuentran en esta ubicación.
     */
    public function ups(): HasMany
    {
        return $this->hasMany(Ups::class, 'ubicacion_actual_id');
    }
}