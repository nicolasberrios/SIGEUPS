<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUpsRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación.
     */
    public function rules(): array
    {
        return [

            'modelo_id' => 'required|exists:modelos,id',

            'propietario_id' => 'required|exists:propietarios,id',

            'estado_actual_id' => 'required|exists:estados,id',

            'ubicacion_actual_id' => 'required|exists:ubicaciones,id',

            'numero_identificador' => 'required|string|max:50',

            'numero_serie' => [
                'required',
                'string',
                'max:100',
                Rule::unique('ups', 'numero_serie')->ignore($this->up),
            ],

            'potencia_kva' => 'required|numeric|min:0.01',

            'observaciones' => 'nullable|string',

            'foto_principal' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',

        ];
    }
}