<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar marca
        </h2>

    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <form method="POST" action="{{ route('catalogos.marcas.update', $marca) }}">

                    @csrf
                    @method('PUT')

                    <div>

                        <label class="block mb-2 font-semibold">
                            Nombre de la marca
                        </label>

                        <input
                            type="text"
                            name="nombre"
                            value="{{ old('nombre', $marca->nombre) }}"
                            class="w-full rounded border-gray-300">

                        @error('nombre')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="mt-8 flex gap-3">

                        <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded">

                            Guardar cambios

                        </button>

                        <a href="{{ route('catalogos.marcas.index') }}"
                           class="bg-gray-300 hover:bg-gray-400 px-6 py-2 rounded">

                            Cancelar

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>