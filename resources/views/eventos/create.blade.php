<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center gap-4">

            <div>

                <h2 class="text-2xl font-bold text-gray-800">

                    Registrar evento

                </h2>

                <p class="text-gray-500">

                    Registra un movimiento o cambio en una UPS.

                </p>

            </div>

            <a href="{{ route('eventos.index') }}"
               class="btn-secondary px-5">

                Volver

            </a>

        </div>

    </x-slot>

    @php

        $upsInicial = old(
            'ups_id',
            $upsSeleccionada
        );

        $equipoInicial = $ups->firstWhere(
            'id',
            (int) $upsInicial
        );

        $estadoInicial = old(
            'estado_resultante_id',
            $equipoInicial?->estado_actual_id
        );

        $ubicacionInicial = old(
            'ubicacion_resultante_id',
            $equipoInicial?->ubicacion_actual_id
        );

        $datosUps = $ups->mapWithKeys(function ($up) {

            return [
                $up->id => [
                    'estado' => $up->estado_actual_id,
                    'ubicacion' => $up->ubicacion_actual_id,
                ],
            ];

        });

    @endphp

    <div class="py-6">

        <div class="max-w-4xl mx-auto px-6">

            @if($errors->any())

                <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-5 py-4 text-red-800">

                    <p class="font-semibold mb-2">

                        Revisa los datos ingresados:

                    </p>

                    <ul class="list-disc pl-5 space-y-1">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <div
                class="panel"
                x-data="{
                    upsId: @js((string) $upsInicial),
                    estadoId: @js((string) $estadoInicial),
                    ubicacionId: @js((string) $ubicacionInicial),
                    equipos: @js($datosUps),

                    actualizarSituacion() {

                        const equipo = this.equipos[this.upsId];

                        if (equipo) {

                            this.estadoId = String(equipo.estado);

                            this.ubicacionId = String(equipo.ubicacion);

                        }

                    }
                }">

                <form
                    method="POST"
                    action="{{ route('eventos.store') }}">

                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="md:col-span-2">

                            <label
                                for="ups_id"
                                class="block mb-2 font-semibold">

                                UPS

                            </label>

                            <select
                                id="ups_id"
                                name="ups_id"
                                x-model="upsId"
                                x-on:change="actualizarSituacion()"
                                class="w-full border-gray-300 rounded-lg"
                                required>

                                <option value="">

                                    Selecciona una UPS

                                </option>

                                @foreach($ups as $up)

                                    <option value="{{ $up->id }}">

                                        {{ $up->numero_identificador }}
                                        —
                                        {{ $up->modelo->marca->nombre }}
                                        {{ $up->modelo->nombre }}
                                        —
                                        {{ $up->numero_serie }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            <label
                                for="tipo_evento_id"
                                class="block mb-2 font-semibold">

                                Tipo de evento

                            </label>

                            <select
                                id="tipo_evento_id"
                                name="tipo_evento_id"
                                class="w-full border-gray-300 rounded-lg"
                                required>

                                <option value="">

                                    Selecciona un tipo

                                </option>

                                @foreach($tiposEvento as $tipo)

                                    <option
                                        value="{{ $tipo->id }}"
                                        @selected(
                                            old('tipo_evento_id') == $tipo->id
                                        )>

                                        {{ $tipo->nombre }}
                                        ({{ $tipo->categoria }})

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            <label
                                for="fecha_hora"
                                class="block mb-2 font-semibold">

                                Fecha y hora

                            </label>

                            <input
                                id="fecha_hora"
                                type="datetime-local"
                                name="fecha_hora"
                                value="{{ old(
                                    'fecha_hora',
                                    now()->format('Y-m-d\TH:i')
                                ) }}"
                                max="{{ now()->format('Y-m-d\TH:i') }}"
                                class="w-full border-gray-300 rounded-lg"
                                required>

                        </div>

                        <div>

                            <label
                                for="estado_resultante_id"
                                class="block mb-2 font-semibold">

                                Estado resultante

                            </label>

                            <select
                                id="estado_resultante_id"
                                name="estado_resultante_id"
                                x-model="estadoId"
                                class="w-full border-gray-300 rounded-lg"
                                required>

                                <option value="">

                                    Selecciona un estado

                                </option>

                                @foreach($estados as $estado)

                                    <option value="{{ $estado->id }}">

                                        {{ $estado->nombre }}
                                        ({{ $estado->categoria }})

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            <label
                                for="ubicacion_resultante_id"
                                class="block mb-2 font-semibold">

                                Ubicación resultante

                            </label>

                            <select
                                id="ubicacion_resultante_id"
                                name="ubicacion_resultante_id"
                                x-model="ubicacionId"
                                class="w-full border-gray-300 rounded-lg"
                                required>

                                <option value="">

                                    Selecciona una ubicación

                                </option>

                                @foreach($ubicaciones as $ubicacion)

                                    <option value="{{ $ubicacion->id }}">

                                        {{ $ubicacion->nombre }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="md:col-span-2">

                            <label
                                for="comentario"
                                class="block mb-2 font-semibold">

                                Comentario

                            </label>

                            <textarea
                                id="comentario"
                                name="comentario"
                                rows="5"
                                maxlength="2000"
                                placeholder="Describe el trabajo, movimiento o situación de la UPS."
                                class="w-full border-gray-300 rounded-lg">{{ old('comentario') }}</textarea>

                        </div>

                    </div>

                    <div class="flex justify-end gap-3 mt-8">

                        <a
                            href="{{ route('eventos.index') }}"
                            class="btn-secondary px-5">

                            Cancelar

                        </a>

                        <button
                            type="submit"
                            class="btn-primary px-5">

                            Guardar evento

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>