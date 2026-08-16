<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar UPS
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <form method="POST" action="{{ route('ups.update', $ups) }}">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block mb-2">Número identificador</label>
                            <input
                                type="text"
                                name="numero_identificador"
                                value="{{ old('numero_identificador', $ups->numero_identificador) }}"
                                class="w-full rounded border-gray-300">
                        </div>

                        <div>
                            <label class="block mb-2">Número de serie</label>
                            <input
                                type="text"
                                name="numero_serie"
                                value="{{ old('numero_serie', $ups->numero_serie) }}"
                                class="w-full rounded border-gray-300">
                        </div>

                        <div>
                            <label class="block mb-2">Potencia (kVA)</label>
                            <input
                                type="number"
                                step="0.01"
                                name="potencia_kva"
                                value="{{ old('potencia_kva', $ups->potencia_kva) }}"
                                class="w-full rounded border-gray-300">
                        </div>

                        <div>
                            <label class="block mb-2">Marca</label>

                            <select name="marca_id" class="w-full rounded border-gray-300">

                                @foreach($marcas as $marca)

                                    <option value="{{ $marca->id }}"
                                        {{ $ups->modelo->marca_id == $marca->id ? 'selected' : '' }}>

                                        {{ $marca->nombre }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div>
                            <label class="block mb-2">Modelo</label>

                            <select name="modelo_id" class="w-full rounded border-gray-300">

                                @foreach($modelos as $modelo)

                                    <option value="{{ $modelo->id }}"
                                        {{ $ups->modelo_id == $modelo->id ? 'selected' : '' }}>

                                        {{ $modelo->nombre }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div>
                            <label class="block mb-2">Propietario</label>

                            <select name="propietario_id" class="w-full rounded border-gray-300">

                                @foreach($propietarios as $propietario)

                                    <option value="{{ $propietario->id }}"
                                        {{ $ups->propietario_id == $propietario->id ? 'selected' : '' }}>

                                        {{ $propietario->nombre }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div>
                            <label class="block mb-2">Estado</label>

                            <select name="estado_actual_id" class="w-full rounded border-gray-300">

                                @foreach($estados as $estado)

                                    <option value="{{ $estado->id }}"
                                        {{ $ups->estado_actual_id == $estado->id ? 'selected' : '' }}>

                                        {{ $estado->nombre }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div>
                            <label class="block mb-2">Ubicación</label>

                            <select name="ubicacion_actual_id" class="w-full rounded border-gray-300">

                                @foreach($ubicaciones as $ubicacion)

                                    <option value="{{ $ubicacion->id }}"
                                        {{ $ups->ubicacion_actual_id == $ubicacion->id ? 'selected' : '' }}>

                                        {{ $ubicacion->nombre }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="md:col-span-2">

                            <label class="block mb-2">Observaciones</label>

                            <textarea
                                name="observaciones"
                                rows="4"
                                class="w-full rounded border-gray-300">{{ old('observaciones', $ups->observaciones) }}</textarea>

                        </div>

                    </div>

                    <div class="mt-8 flex gap-3">

                        <button
                            type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded">

                            Guardar cambios

                        </button>

                        <a href="{{ route('ups.index') }}"
                           class="bg-gray-300 hover:bg-gray-400 px-6 py-2 rounded">

                            Cancelar

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>