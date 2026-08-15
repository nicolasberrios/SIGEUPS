<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estado extends Model
{
    protected $table = 'estados';

    protected $fillable = [
        'nombre',
        'categoria',
    ];

    /**
     * UPS que actualmente poseen este estado.
     */
    public function ups(): HasMany
    {
        return $this->hasMany(Ups::class, 'estado_actual_id');
    }
}