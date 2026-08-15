<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Propietario extends Model
{
    protected $table = 'propietarios';

    protected $fillable = [
        'nombre',
        'sucursal',
    ];

    /**
     * UPS pertenecientes al propietario.
     */
    public function ups(): HasMany
    {
        return $this->hasMany(Ups::class);
    }
}