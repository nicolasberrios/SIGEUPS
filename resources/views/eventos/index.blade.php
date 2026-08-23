<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center gap-4">

            <div>

                <h2 class="text-2xl font-bold text-gray-800">

                    Eventos

                </h2>

                <p class="text-gray-500">

                    Historial de movimientos y cambios registrados en las UPS.

                </p>

            </div>

            <a href="{{ route('eventos.create') }}"
               class="btn-primary px-5">

                Nuevo evento

            </a>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto px-6">

            @if(session('success'))

                <div class="mb-5 rounded-lg border border-green-200 bg-green-50 px-5 py-4 text-green-800">

                    {{ session('success') }}

                </div>

            @endif

            {{-- ================= FILTROS ================= --}}

            <div class="panel mb-5">

                <form action="{{ route('eventos.index') }}"
                      method="GET">

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                        <div>

                            <label for="q"
                                   class="block mb-2 font-semibold">

                                Buscar

                            </label>

                            <input
                                id="q"
                                type="text"
                                name="q"
                                value="{{ $texto }}"
                                placeholder="UPS, tipo, usuario o comentario..."
                                class="w-full border-gray-300 rounded-lg">

                        </div>

                        <div>

                            <label for="ups"
                                   class="block mb-2 font-semibold">

                                UPS

                            </label>

                            <select
                                id="ups"
                                name="ups"
                                class="w-full border-gray-300 rounded-lg">

                                <option value="">

                                    Todas

                                </option>

                                @foreach($ups as $up)

                                    <option
                                        value="{{ $up->id }}"
                                        @selected($upsSeleccionada == $up->id)>

                                        {{ $up->numero_identificador }}
                                        —
                                        {{ $up->numero_serie }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            <label for="tipo_evento"
                                   class="block mb-2 font-semibold">

                                Tipo de evento

                            </label>

                            <select
                                id="tipo_evento"
                                name="tipo_evento"
                                class="w-full border-gray-300 rounded-lg">

                                <option value="">

                                    Todos

                                </option>

                                @foreach($tiposEvento as $tipo)

                                    <option
                                        value="{{ $tipo->id }}"
                                        @selected(
                                            $tipoEventoSeleccionado == $tipo->id
                                        )>

                                        {{ $tipo->nombre }}
                                        ({{ $tipo->categoria }})

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            <label for="usuario"
                                   class="block mb-2 font-semibold">

                                Usuario

                            </label>

                            <select
                                id="usuario"
                                name="usuario"
                                class="w-full border-gray-300 rounded-lg">

                                <option value="">

                                    Todos

                                </option>

                                @foreach($usuarios as $usuario)

                                    <option
                                        value="{{ $usuario->id }}"
                                        @selected(
                                            $usuarioSeleccionado == $usuario->id
                                        )>

                                        {{ $usuario->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            <label for="fecha_desde"
                                   class="block mb-2 font-semibold">

                                Desde

                            </label>

                            <input
                                id="fecha_desde"
                                type="date"
                                name="fecha_desde"
                                value="{{ $fechaDesde }}"
                                class="w-full border-gray-300 rounded-lg">

                        </div>

                        <div>

                            <label for="fecha_hasta"
                                   class="block mb-2 font-semibold">

                                Hasta

                            </label>

                            <input
                                id="fecha_hasta"
                                type="date"
                                name="fecha_hasta"
                                value="{{ $fechaHasta }}"
                                class="w-full border-gray-300 rounded-lg">

                        </div>

                    </div>

                    <div class="flex justify-end gap-3 mt-5">

                        <a href="{{ route('eventos.index') }}"
                           class="btn-secondary px-5">

                            Limpiar

                        </a>

                        <button
                            type="submit"
                            class="btn-primary px-5">

                            Buscar

                        </button>

                    </div>

                </form>

            </div>

            {{-- ================= LISTADO ================= --}}

            <div class="panel overflow-x-auto">

                <table class="table-sigeups min-w-full">

                    <thead>

                        <tr>

                            <th>Fecha y hora</th>

                            <th>UPS</th>

                            <th>Evento</th>

                            <th>Estado resultante</th>

                            <th>Ubicación</th>

                            <th>Registrado por</th>

                            <th></th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($eventos as $evento)

                            <tr>

                                <td class="whitespace-nowrap">

                                    {{ $evento->fecha_hora->format('d-m-Y H:i') }}

                                </td>

                                <td>

                                    <a
                                        href="{{ route('ups.show', $evento->ups) }}"
                                        class="font-semibold text-red-600 hover:text-red-800">

                                        {{ $evento->ups->numero_identificador }}

                                    </a>

                                </td>

                                <td>

                                    <div class="font-semibold">

                                        {{ $evento->tipoEvento->nombre }}

                                    </div>

                                    <div class="text-xs text-gray-500">

                                        {{ $evento->tipoEvento->categoria }}

                                    </div>

                                </td>

                                <td>

                                    {{ $evento->estadoResultante->nombre }}

                                </td>

                                <td>

                                    {{ $evento->ubicacionResultante->nombre }}

                                </td>

                                <td>

                                    {{ $evento->usuario->name }}

                                </td>

                                <td class="text-right">

                                    <a
                                        href="{{ route('eventos.show', $evento) }}"
                                        class="text-red-600 font-semibold hover:text-red-800">

                                        Detalle

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7"
                                    class="text-center py-8 text-gray-500">

                                    No se encontraron eventos.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

                <div class="mt-6">

                    {{ $eventos->links() }}

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
