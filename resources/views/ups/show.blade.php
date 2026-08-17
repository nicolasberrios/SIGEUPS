<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ficha de la UPS
            </h2>

            <div class="flex gap-2">

                <a href="{{ route('ups.edit', $up) }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">

                    Editar

                </a>

                <a href="{{ route('ups.index') }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">

                    Volver

                </a>

            </div>

        </div>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- INFORMACIÓN GENERAL --}}

            <div class="bg-white rounded-lg shadow p-8 mb-6">

                <h2 class="text-2xl font-bold mb-6">

                    UPS {{ $up->numero_identificador }}

                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    <div>
                        <p class="text-sm text-gray-500">Estado</p>
                        <p class="font-semibold text-lg">
                            {{ $up->estadoActual->nombre }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Propietario</p>
                        <p>{{ $up->propietario->nombre }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Marca</p>
                        <p>{{ $up->modelo->marca->nombre }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Modelo</p>
                        <p>{{ $up->modelo->nombre }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Potencia</p>
                        <p>{{ number_format($up->potencia_kva,2) }} kVA</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Ubicación</p>
                        <p>{{ $up->ubicacionActual->nombre }}</p>
                    </div>

                </div>

                @if($up->observaciones)

                    <div class="mt-8">

                        <p class="text-sm text-gray-500 mb-2">

                            Observaciones

                        </p>

                        <div class="border rounded-lg p-4 bg-gray-50">

                            {{ $up->observaciones }}

                        </div>

                    </div>

                @endif

            </div>

            {{-- EVENTOS --}}

            <div class="bg-white rounded-lg shadow p-6 mb-6">

                <div class="flex justify-between items-center">

                    <h3 class="text-xl font-semibold">

                        Eventos

                    </h3>

                    <button
                        class="bg-red-600 text-white px-4 py-2 rounded opacity-50 cursor-not-allowed">

                        Registrar evento

                    </button>

                </div>

                <div class="mt-6 text-gray-500">

                    No existen eventos registrados.

                </div>

            </div>

            {{-- INTERVENCIONES --}}

            <div class="bg-white rounded-lg shadow p-6 mb-6">

                <h3 class="text-xl font-semibold mb-4">

                    Intervenciones

                </h3>

                <p class="text-gray-500">

                    No existen intervenciones registradas.

                </p>

            </div>

            {{-- DOCUMENTOS --}}

            <div class="bg-white rounded-lg shadow p-6 mb-6">

                <h3 class="text-xl font-semibold mb-4">

                    Documentos

                </h3>

                <p class="text-gray-500">

                    No existen documentos asociados.

                </p>

            </div>

            {{-- FOTOGRAFÍAS --}}

            <div class="bg-white rounded-lg shadow p-6 mb-6">

                <h3 class="text-xl font-semibold mb-4">

                    Fotografías

                </h3>

                <p class="text-gray-500">

                    No existen fotografías registradas.

                </p>

            </div>

            {{-- ASIGNACIONES --}}

            <div class="bg-white rounded-lg shadow p-6">

                <h3 class="text-xl font-semibold mb-4">

                    Asignaciones

                </h3>

                <p class="text-gray-500">

                    No existen asignaciones registradas.

                </p>

            </div>

        </div>

    </div>

</x-app-layout>