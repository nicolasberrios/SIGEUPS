<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center gap-4">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">

                Ficha de la UPS

            </h2>

            <div class="flex gap-2">

                <a
                    href="{{ route('ups.edit', $up) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">

                    Editar

                </a>

                <a
                    href="{{ route('ups.index') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">

                    Volver

                </a>

            </div>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto px-6">

            {{-- ================= INFORMACIÓN GENERAL ================= --}}

            <div class="bg-white rounded-lg shadow p-8 mb-6">

                <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                    <div class="lg:col-span-1">

                        @if($up->foto_principal)

                            <img
                                src="{{ asset('storage/' . $up->foto_principal) }}"
                                alt="Foto principal de la UPS"
                                class="w-full h-64 object-cover rounded-lg border">

                        @else

                            <div class="w-full h-64 rounded-lg border bg-gray-100 flex items-center justify-center text-gray-500">

                                Sin foto principal

                            </div>

                        @endif

                    </div>

                    <div class="lg:col-span-3">

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

                                <p>{{ number_format($up->potencia_kva, 2) }} kVA</p>

                            </div>

                            <div>

                                <p class="text-sm text-gray-500">Ubicación</p>

                                <p>{{ $up->ubicacionActual->nombre }}</p>

                            </div>

                            <div>

                                <p class="text-sm text-gray-500">Número de serie</p>

                                <p>{{ $up->numero_serie }}</p>

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

                </div>

            </div>

            {{-- ================= EVENTOS ================= --}}

            <div class="bg-white rounded-lg shadow p-6 mb-6">

                <div class="flex justify-between items-center gap-4">

                    <div>

                        <h3 class="text-xl font-semibold">

                            Eventos

                        </h3>

                        <p class="text-sm text-gray-500 mt-1">

                            Historial de movimientos y cambios de la UPS.

                        </p>

                    </div>

                    <a
                        href="{{ route('eventos.create', ['ups' => $up->id]) }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">

                        Registrar evento

                    </a>

                </div>

                @if($up->eventos->isEmpty())

                    <div class="mt-6 text-gray-500">

                        No existen eventos registrados.

                    </div>

                @else

                    <div class="mt-6 overflow-x-auto">

                        <table class="table-sigeups min-w-full">

                            <thead>

                                <tr>

                                    <th>Fecha y hora</th>

                                    <th>Tipo de evento</th>

                                    <th>Estado resultante</th>

                                    <th>Ubicación</th>

                                    <th>Usuario</th>

                                    <th></th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($up->eventos as $evento)

                                    <tr>

                                        <td class="whitespace-nowrap">

                                            {{ $evento->fecha_hora->format('d-m-Y H:i') }}

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

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @endif

            </div>

            {{-- ================= INTERVENCIONES ================= --}}

            <div class="bg-white rounded-lg shadow p-6 mb-6">

                <h3 class="text-xl font-semibold mb-4">

                    Intervenciones

                </h3>

                <p class="text-gray-500">

                    No existen intervenciones registradas.

                </p>

            </div>

            {{-- ================= DOCUMENTOS ================= --}}

            <div class="bg-white rounded-lg shadow p-6 mb-6">

                <h3 class="text-xl font-semibold mb-4">

                    Documentos

                </h3>

                <p class="text-gray-500">

                    No existen documentos asociados.

                </p>

            </div>

                        {{-- ================= FOTOGRAFÍAS ================= --}}

            <div class="bg-white rounded-lg shadow p-6 mb-6">

                <div class="flex justify-between items-center gap-4 mb-6">

                    <div>

                        <h3 class="text-xl font-semibold">

                            Fotografías

                        </h3>

                        <p class="text-sm text-gray-500 mt-1">

                            Registro visual asociado a la UPS.

                        </p>

                    </div>

                </div>

                <form
                    method="POST"
                    action="{{ route('fotografias.store', $up) }}"
                    enctype="multipart/form-data"
                    class="border rounded-lg p-4 mb-6 bg-gray-50">

                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        <div>

                            <label class="block mb-2 font-semibold">

                                Fotografía

                            </label>

                            <input
                                type="file"
                                name="imagen"
                                accept="image/*"
                                class="w-full rounded border-gray-300">

                            @error('imagen')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror

                        </div>

                        <div class="md:col-span-2">

                            <label class="block mb-2 font-semibold">

                                Descripción

                            </label>

                            <input
                                type="text"
                                name="descripcion"
                                value="{{ old('descripcion') }}"
                                placeholder="Ejemplo: estado frontal, instalación, daño visible..."
                                class="w-full rounded border-gray-300">

                            @error('descripcion')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror

                        </div>

                    </div>

                    <div class="mt-4">

                        <button
                            type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded">

                            Subir fotografía

                        </button>

                    </div>

                </form>

                @if($up->fotografias->isEmpty() && ! $up->foto_principal)

                    <p class="text-gray-500">

                        No existen fotografías registradas.

                    </p>

                @else

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">

                        @if($up->foto_principal)

                            <div class="border rounded-lg p-3 bg-white">

                                <img
                                    src="{{ asset('storage/' . $up->foto_principal) }}"
                                    alt="Foto principal de la UPS"
                                    class="w-full h-40 object-cover rounded">

                                <p class="text-sm font-semibold mt-2">

                                    Foto principal

                                </p>

                                <p class="text-xs text-gray-500">

                                    Imagen principal del equipo

                                </p>

                            </div>

                        @endif

                        @foreach($up->fotografias as $fotografia)

                            <div class="border rounded-lg p-3 bg-white">

                                <img
                                    src="{{ asset('storage/' . $fotografia->ruta) }}"
                                    alt="Fotografía de la UPS"
                                    class="w-full h-40 object-cover rounded">

                                <p class="text-sm font-semibold mt-2">

                                    {{ $fotografia->descripcion ?? 'Sin descripción' }}

                                </p>

                                <p class="text-xs text-gray-500 mt-1">

                                    Subida por {{ $fotografia->usuario->name }}

                                </p>

                                <p class="text-xs text-gray-500">

                                    {{ $fotografia->created_at->format('d-m-Y H:i') }}

                                </p>

                                @if(auth()->user()->isAdmin())

                                    <form
                                        method="POST"
                                        action="{{ route('fotografias.destroy', $fotografia) }}"
                                        class="mt-3"
                                        onsubmit="return confirm('¿Eliminar esta fotografía?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="text-red-600 text-sm font-semibold hover:text-red-800">

                                            Eliminar

                                        </button>

                                    </form>

                                @endif

                            </div>

                        @endforeach

                    </div>

                @endif

            </div>
            
            {{-- ================= ASIGNACIONES ================= --}}

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