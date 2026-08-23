<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center">

            <div>

                <h2 class="text-2xl font-bold text-gray-800">
                    Resultados de búsqueda
                </h2>

                <p class="text-gray-500">
                    Búsqueda: <strong>"{{ $texto }}"</strong>
                </p>

            </div>

            <a href="{{ route('dashboard') }}"
               class="btn-secondary">

                Volver al Inicio

            </a>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="panel">

                <div class="mb-5">

                    <strong>

                        {{ $ups->count() }}

                    </strong>

                    resultado(s) encontrado(s).

                </div>

                <table class="table-sigeups">

                    <thead>

                        <tr>

                            <th>Identificador</th>

                            <th>Marca</th>

                            <th>Modelo</th>

                            <th>Propietario</th>

                            <th>Estado</th>

                            <th>Ubicación</th>

                            <th></th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($ups as $up)

                            <tr>

                                <td>

                                    {{ $up->numero_identificador }}

                                </td>

                                <td>

                                    {{ $up->modelo->marca->nombre }}

                                </td>

                                <td>

                                    {{ $up->modelo->nombre }}

                                </td>

                                <td>

                                    {{ $up->propietario->nombre }}

                                </td>

                                <td>

                                    {{ $up->estadoActual->nombre }}

                                </td>

                                <td>

                                    {{ $up->ubicacionActual->nombre }}

                                </td>

                                <td>

                                    <a
                                        href="{{ route('ups.show', $up) }}"
                                        class="btn-primary">

                                        Ver

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7"
                                    class="text-center py-10 text-gray-500">

                                    No se encontraron UPS para esta búsqueda.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>