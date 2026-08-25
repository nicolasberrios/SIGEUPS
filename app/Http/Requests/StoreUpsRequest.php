<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpsRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación para registrar una UPS.
     */
    public function rules(): array
    {
        return [
            'modelo_id' => ['required', 'exists:modelos,id'],
            'propietario_id' => ['required', 'exists:propietarios,id'],
            'estado_actual_id' => ['required', 'exists:estados,id'],
            'ubicacion_actual_id' => ['required', 'exists:ubicaciones,id'],

            'numero_identificador' => ['required', 'string', 'max:50', 'unique:ups,numero_identificador'],
            'numero_serie' => ['required', 'string', 'max:100', 'unique:ups,numero_serie'],
            'potencia_kva' => ['required', 'numeric', 'min:0'],

            'foto_principal' => ['nullable', 'image', 'max:4096'],
            'observaciones' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [
            'modelo_id.required' => 'Debe seleccionar un modelo.',
            'propietario_id.required' => 'Debe seleccionar un propietario.',
            'estado_actual_id.required' => 'Debe seleccionar un estado.',
            'ubicacion_actual_id.required' => 'Debe seleccionar una ubicación.',

            'numero_identificador.required' => 'Debe ingresar el número identificador.',
            'numero_identificador.unique' => 'El número identificador ya se encuentra registrado.',

            'numero_serie.required' => 'Debe ingresar el número de serie.',
            'numero_serie.unique' => 'El número de serie ya se encuentra registrado.',

            'potencia_kva.required' => 'Debe ingresar la potencia de la UPS.',
            'potencia_kva.numeric' => 'La potencia debe ser un valor numérico.',

            'foto_principal.image' => 'La foto principal debe ser una imagen.',
            'foto_principal.max' => 'La foto principal no debe superar los 4 MB.',
        ];
    }
}