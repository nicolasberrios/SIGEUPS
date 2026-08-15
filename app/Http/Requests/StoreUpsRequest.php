<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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

            'numero_serie' => 'required|string|max:100|unique:ups,numero_serie',

            'potencia_kva' => 'required|string|max:20',

            'observaciones' => 'nullable|string',

            'foto_principal' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',

        ];
    }
}