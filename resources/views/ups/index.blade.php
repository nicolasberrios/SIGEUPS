<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center">

            <div>

                <h2 class="text-2xl font-bold text-gray-800">

                    Gestión de UPS

                </h2>

                <p class="text-gray-500">

                    Administración y búsqueda de equipos UPS.

                </p>

            </div>

            <a href="{{ route('ups.create') }}"
               class="btn-primary">

                Registrar UPS

            </a>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto px-6">

            {{-- ================= FILTROS ================= --}}

            <div class="panel mb-5">

                <form action="{{ route('ups.index') }}"
                      method="GET">

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                        <div>

                            <label class="block mb-2 font-semibold">

                                Buscar

                            </label>

                            <input
                                type="text"
                                name="q"
                                value="{{ $texto }}"
                                placeholder="Identificador, serie, marca..."
                                class="w-full border rounded-lg px-4 py-3">

                        </div>

                        <div>

                            <label class="block mb-2 font-semibold">

                                Estado

                            </label>

                            <select
                                name="estado"
                                class="w-full border rounded-lg px-4 py-3">

                                <option value="">

                                    Todos

                                </option>

                                @foreach($estados as $estado)

                                    <option
                                        value="{{ $estado->id }}"
                                        @selected($estadoSeleccionado == $estado->id)>

                                        {{ $estado->nombre }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            <label class="block mb-2 font-semibold">

                                Propietario

                            </label>

                            <select
                                name="propietario"
                                class="w-full border rounded-lg px-4 py-3">

                                <option value="">

                                    Todos

                                </option>

                                @foreach($propietarios as $propietario)

                                    <option
                                        value="{{ $propietario->id }}"
                                        @selected($propietarioSeleccionado == $propietario->id)>

                                        {{ $propietario->nombre }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            <label class="block mb-2 font-semibold">

                                Ubicación

                            </label>

                            <select
                                name="ubicacion"
                                class="w-full border rounded-lg px-4 py-3">

                                <option value="">

                                    Todas

                                </option>

                                @foreach($ubicaciones as $ubicacion)

                                    <option
                                        value="{{ $ubicacion->id }}"
                                        @selected($ubicacionSeleccionada == $ubicacion->id)>

                                        {{ $ubicacion->nombre }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="flex justify-end gap-3 mt-5">

                        <a href="{{ route('ups.index') }}"
                           class="btn-secondary">

                            Limpiar

                        </a>

                        <button
                            type="submit"
                            class="btn-primary">

                            Buscar

                        </button>

                    </div>

                </form>

            </div>

            {{-- ================= TABLA ================= --}}

            <div class="panel">

                <table class="table-sigeups">

                    <thead>

                        <tr>

                            <th>Estado</th>

                            <th>Identificador</th>

                            <th>Propietario</th>

                            <th>Marca</th>

                            <th>Modelo</th>

                            <th>Ubicación</th>

                            <th></th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($ups as $up)

                            <tr>

                                <td>

                                    {{ $up->estadoActual->nombre }}

                                </td>

                                <td>

                                    <strong>

                                        {{ $up->numero_identificador }}

                                    </strong>

                                </td>

                                <td>

                                    {{ $up->propietario->nombre }}

                                </td>

                                <td>

                                    {{ $up->modelo->marca->nombre }}

                                </td>

                                <td>

                                    {{ $up->modelo->nombre }}

                                </td>

                                <td>

                                    {{ $up->ubicacionActual->nombre }}

                                </td>

                                <td class="text-right">

                                    <a
                                        href="{{ route('ups.show', $up) }}"
                                        class="btn-secondary">

                                        Detalle

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7"
                                    class="text-center py-8 text-gray-500">

                                    No se encontraron UPS.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

                <div class="mt-6">

                    {{ $ups->links() }}

                </div>

            </div>

        </div>

    </div>

</x-app-layout>