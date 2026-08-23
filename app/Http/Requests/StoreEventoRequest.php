<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventoRequest extends FormRequest
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
            'ups_id' => [
                'required',
                'integer',
                'exists:ups,id',
            ],

            'tipo_evento_id' => [
                'required',
                'integer',
                'exists:tipos_evento,id',
            ],

            'estado_resultante_id' => [
                'required',
                'integer',
                'exists:estados,id',
            ],

            'ubicacion_resultante_id' => [
                'required',
                'integer',
                'exists:ubicaciones,id',
            ],

            'fecha_hora' => [
                'required',
                'date',
                'before_or_equal:now',
            ],

            'comentario' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ];
    }

    /**
     * Mensajes de validación.
     */
    public function messages(): array
    {
        return [
            'ups_id.required' =>
                'Debes seleccionar una UPS.',

            'ups_id.exists' =>
                'La UPS seleccionada no existe.',

            'tipo_evento_id.required' =>
                'Debes seleccionar un tipo de evento.',

            'tipo_evento_id.exists' =>
                'El tipo de evento seleccionado no existe.',

            'estado_resultante_id.required' =>
                'Debes seleccionar el estado resultante.',

            'estado_resultante_id.exists' =>
                'El estado seleccionado no existe.',

            'ubicacion_resultante_id.required' =>
                'Debes seleccionar la ubicación resultante.',

            'ubicacion_resultante_id.exists' =>
                'La ubicación seleccionada no existe.',

            'fecha_hora.required' =>
                'Debes indicar la fecha y hora del evento.',

            'fecha_hora.date' =>
                'La fecha y hora no tienen un formato válido.',

            'fecha_hora.before_or_equal' =>
                'La fecha y hora no pueden ser futuras.',

            'comentario.max' =>
                'El comentario no puede superar los 2000 caracteres.',
        ];
    }
}