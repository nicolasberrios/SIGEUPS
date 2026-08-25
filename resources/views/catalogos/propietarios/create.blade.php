<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear propietario
        </h2>

    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <form method="POST" action="{{ route('catalogos.propietarios.store') }}">

                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>

                            <label class="block mb-2 font-semibold">
                                Nombre del propietario
                            </label>

                            <input
                                type="text"
                                name="nombre"
                                value="{{ old('nombre') }}"
                                class="w-full rounded border-gray-300">

                            @error('nombre')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror

                        </div>

                        <div>

                            <label class="block mb-2 font-semibold">
                                Sucursal
                            </label>

                            <input
                                type="text"
                                name="sucursal"
                                value="{{ old('sucursal') }}"
                                class="w-full rounded border-gray-300">

                            @error('sucursal')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror

                        </div>

                    </div>

                    <div class="mt-8 flex gap-3">

                        <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded">

                            Guardar propietario

                        </button>

                        <a href="{{ route('catalogos.propietarios.index') }}"
                           class="bg-gray-300 hover:bg-gray-400 px-6 py-2 rounded">

                            Cancelar

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>