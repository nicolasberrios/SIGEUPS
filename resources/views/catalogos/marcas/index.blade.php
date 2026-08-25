<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center gap-4">

            <div>

                <h2 class="text-2xl font-bold text-gray-800">
                    Marcas
                </h2>

                <p class="text-gray-500">
                    Administración de marcas de UPS.
                </p>

            </div>

            <div class="flex gap-2">

                <a href="{{ route('catalogos.marcas.index') }}"
                   class="btn-primary">

                    Marcas

                </a>

                <a href="{{ route('catalogos.modelos.index') }}"
                   class="btn-secondary">

                    Modelos

                </a>

                <a href="{{ route('catalogos.propietarios.index') }}"
                   class="btn-secondary">

                    Propietarios

                </a>

                <a href="{{ route('catalogos.marcas.create') }}"
                   class="btn-primary">

                    Crear marca

                </a>

            </div>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto px-6">

            @if(session('success'))

                <div class="mb-4 bg-green-100 text-green-800 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>

            @endif

            @if(session('error'))

                <div class="mb-4 bg-red-100 text-red-800 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>

            @endif

            <div class="panel mb-5">

                <form method="GET" action="{{ route('catalogos.marcas.index') }}">

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                        <div class="md:col-span-3">

                            <label class="block mb-2 font-semibold">
                                Buscar marca
                            </label>

                            <input
                                type="text"
                                name="q"
                                value="{{ $texto }}"
                                placeholder="Nombre de marca..."
                                class="w-full border rounded-lg px-4 py-3">

                        </div>

                        <div class="flex items-end gap-3">

                            <button type="submit" class="btn-primary">
                                Buscar
                            </button>

                            <a href="{{ route('catalogos.marcas.index') }}"
                               class="btn-secondary">

                                Limpiar

                            </a>

                        </div>

                    </div>

                </form>

            </div>

            <div class="panel">

                <table class="table-sigeups">

                    <thead>

                        <tr>

                            <th>Marca</th>
                            <th>Modelos asociados</th>
                            <th></th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($marcas as $marca)

                            <tr>

                                <td>
                                    <strong>{{ $marca->nombre }}</strong>
                                </td>

                                <td>
                                    {{ $marca->modelos_count }}
                                </td>

                                <td class="text-right whitespace-nowrap">

                                    <a href="{{ route('catalogos.marcas.edit', $marca) }}"
                                       class="btn-secondary">

                                        Editar

                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('catalogos.marcas.destroy', $marca) }}"
                                        class="inline ml-2"
                                        onsubmit="return confirm('¿Eliminar esta marca?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="text-red-600 font-semibold hover:text-red-800">

                                            Eliminar

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="3" class="text-center py-8 text-gray-500">
                                    No se encontraron marcas.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

                <div class="mt-6">
                    {{ $marcas->links() }}
                </div>

            </div>

        </div>

    </div>

</x-app-layout>